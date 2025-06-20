<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }

    public function shop(): string
    {
        $guitarModel = new \App\Models\GuitarModel();
        $guitars = $guitarModel->findAll();
        return view('shop', ['guitars' => $guitars]);
    }

    public function addToCart($guitarId)
    {
        $guitarModel = new \App\Models\GuitarModel();
        $guitar = $guitarModel->find($guitarId);
        if (!$guitar || $guitar['stock'] <= 0) {
            return redirect()->to('/shop')->with('error', 'This guitar is out of stock.');
        }
        $cart = session()->get('cart') ?? [];
        if (isset($cart[$guitarId])) {
            $cart[$guitarId]['quantity']++;
        } else {
            $cart[$guitarId] = [
                'id' => $guitar['id'],
                'name' => $guitar['name'],
                'price' => $guitar['price'],
                'image' => $guitar['image'],
                'stock' => $guitar['stock'],
                'quantity' => 1
            ];
        }
        session()->set('cart', $cart);
        return redirect()->to('/shop')->with('success', 'Added to cart!');
    }

    public function cart()
    {
        $cart = session()->get('cart') ?? [];
        return view('cart', ['cart' => $cart]);
    }

    public function updateCart($guitarId)
    {
        $cart = session()->get('cart') ?? [];
        $quantity = (int) $this->request->getPost('quantity');
        if (isset($cart[$guitarId])) {
            if ($quantity > 0) {
                $cart[$guitarId]['quantity'] = $quantity;
            } else {
                unset($cart[$guitarId]);
            }
            session()->set('cart', $cart);
        }
        return redirect()->to('/cart')->with('success', 'Cart updated.');
    }

    public function removeFromCart($guitarId)
    {
        $cart = session()->get('cart') ?? [];
        if (isset($cart[$guitarId])) {
            unset($cart[$guitarId]);
            session()->set('cart', $cart);
        }
        return redirect()->to('/cart')->with('success', 'Item removed from cart.');
    }

    public function checkoutPage()
    {
        $cart = session()->get('cart') ?? [];
        if (empty($cart)) {
            return redirect()->to('/cart')->with('error', 'Your cart is empty.');
        }
        return view('checkout', ['cart' => $cart]);
    }

    public function checkout()
    {
        $cart = session()->get('cart') ?? [];
        if (empty($cart)) {
            return redirect()->to('/cart')->with('error', 'Your cart is empty.');
        }
        $fullname = $this->request->getPost('fullname');
        $address = $this->request->getPost('address');
        $phone = $this->request->getPost('phone');
        if (!$fullname || !$address || !$phone) {
            return redirect()->to('/checkout')->with('error', 'Please fill in all required details.');
        }
        $guitarModel = new \App\Models\GuitarModel();
        $orderModel = new \App\Models\OrderModel();
        $userId = session()->get('user_id');
        $errors = [];
        // Check stock
        foreach ($cart as $item) {
            $guitar = $guitarModel->find($item['id']);
            if (!$guitar || $guitar['stock'] < $item['quantity']) {
                $errors[] = $item['name'] . ' does not have enough stock.';
            }
        }
        if (!empty($errors)) {
            return redirect()->to('/cart')->with('error', implode('<br>', $errors));
        }
        // Place orders and decrement stock
        foreach ($cart as $item) {
            $guitar = $guitarModel->find($item['id']);
            $orderModel->insert([
                'user_id' => $userId,
                'product_id' => $item['id'],
                'guitar_name' => $item['name'],
                'quantity' => $item['quantity'],
                'total_price' => $item['price'] * $item['quantity'],
                'status' => 'Pending',
                'fullname' => $fullname,
                'address' => $address,
                'phone' => $phone
            ]);
            $guitarModel->update($item['id'], [
                'stock' => $guitar['stock'] - $item['quantity']
            ]);
        }
        session()->remove('cart');
        // Set admin alert
        session()->setFlashdata('admin_alert', 'A new order has been placed!');
        return redirect()->to('/shop')->with('success', 'Order placed successfully!');
    }
}
