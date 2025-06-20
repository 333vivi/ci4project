<?php

namespace App\Controllers;

use App\Models\GuitarModel;
use App\Models\OrderModel;
use App\Models\UserModel;

class AdminController extends BaseController
{
    public function dashboard()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/login')->with('error', 'Access denied.');
        }
        $userModel = new \App\Models\UserModel();
        $guitarModel = new \App\Models\GuitarModel();
        $orderModel = new \App\Models\OrderModel();
        $data = [
            'userCount' => $userModel->countAllResults(),
            'guitarCount' => $guitarModel->countAllResults(),
            'orderCount' => $orderModel->countAllResults(),
            'admin_alert' => session()->getFlashdata('admin_alert')
        ];
        return view('admin/dashboard', $data);
    }

    // Guitar Management
    public function guitars()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/login')->with('error', 'Access denied.');
        }
        $guitarModel = new GuitarModel();
        $data['guitars'] = $guitarModel->findAll();
        return view('admin/guitars', $data);
    }

    public function addGuitar()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/login')->with('error', 'Access denied.');
        }
        return view('admin/add_guitar');
    }

    public function saveGuitar()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/login')->with('error', 'Access denied.');
        }
        $guitarModel = new GuitarModel();
        $image = $this->request->getFile('image'); // Get the uploaded file

        // Check if an image is uploaded
        if ($image->isValid() && !$image->hasMoved()) {
            // Generate a random name for the file to avoid conflicts
            $newName = $image->getRandomName();
            
            // Move the image to the 'public/uploads' folder
            $image->move('public/uploads', $newName);
        }

        // Save the guitar data along with the image name
        $guitarModel->save([
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'price' => $this->request->getPost('price'),
            'stock' => $this->request->getPost('stock'),
            'brand' => $this->request->getPost('brand'),
            'type' => $this->request->getPost('type'),
            'image' => isset($newName) ? $newName : null // Save the image name if it was uploaded
        ]);

        return redirect()->to('/admin/guitars');
    }

    public function editGuitar($id)
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/login')->with('error', 'Access denied.');
        }
        $guitarModel = new GuitarModel();
        $data['guitar'] = $guitarModel->find($id);
        return view('admin/edit_guitar', $data);
    }

    public function updateGuitar($id)
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/login')->with('error', 'Access denied.');
        }
        $guitarModel = new GuitarModel();
        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'price' => $this->request->getPost('price'),
            'stock' => $this->request->getPost('stock'),
            'brand' => $this->request->getPost('brand'),
            'type' => $this->request->getPost('type')
        ];
        $image = $this->request->getFile('image');
        if ($image && $image->isValid() && !$image->hasMoved()) {
            $newName = $image->getRandomName();
            $image->move('public/uploads', $newName);
            $data['image'] = $newName;
        }
        $guitarModel->update($id, $data);
        return redirect()->to('/admin/guitars');
    }

    public function deleteGuitar($id)
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/login')->with('error', 'Access denied.');
        }
        $guitarModel = new GuitarModel();
        $orderModel = new \App\Models\OrderModel();
        $guitar = $guitarModel->find($id);
        if (!$guitar) {
            return redirect()->to('/admin/guitars')->with('error', 'Guitar not found.');
        }
        // Only allow deletion if stock is 0
        if ((int)$guitar['stock'] !== 0) {
            return redirect()->to('/admin/guitars')->with('error', 'Cannot delete: Guitar stock must be 0 to delete.');
        }
        // Check referencing orders
        $referencingOrders = $orderModel->where('product_id', $id)->findAll();
        if ($referencingOrders) {
            $allowedStatuses = ['Shipped', 'Completed', 'Cancelled'];
            foreach ($referencingOrders as $order) {
                if (!in_array($order['status'], $allowedStatuses)) {
                    return redirect()->to('/admin/guitars')->with('error', 'Cannot delete: This guitar is referenced in one or more active orders.');
                }
            }
        }
        // Delete image file if exists
        if (!empty($guitar['image'])) {
            $imagePath = FCPATH . 'public/uploads/' . $guitar['image'];
            if (file_exists($imagePath)) {
                @unlink($imagePath);
            }
        }
        if ($guitarModel->delete($id)) {
            return redirect()->to('/admin/guitars')->with('success', 'Guitar deleted successfully.');
        } else {
            return redirect()->to('/admin/guitars')->with('error', 'Failed to delete guitar.');
        }
    }

    // Order Management
    public function orders()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/login')->with('error', 'Access denied.');
        }
        $orderModel = new \App\Models\OrderModel();
        $userModel = new \App\Models\UserModel();
        $guitarModel = new \App\Models\GuitarModel();
        $orders = $orderModel->findAll();
        // Attach user and guitar info
        foreach ($orders as &$order) {
            $order['user'] = $userModel->find($order['user_id']);
            $guitar = $guitarModel->find($order['product_id']);
            if ($guitar) {
                $order['guitar'] = $guitar;
            } // else do not set 'guitar', so 'guitar_name' is used in the view
        }
        return view('admin/orders', ['orders' => $orders]);
    }

    public function viewOrder($id)
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/login')->with('error', 'Access denied.');
        }
        $orderModel = new \App\Models\OrderModel();
        $userModel = new \App\Models\UserModel();
        $guitarModel = new \App\Models\GuitarModel();
        $order = $orderModel->find($id);
        if (!$order) {
            return redirect()->to('/admin/orders')->with('error', 'Order not found.');
        }
        $order['user'] = $userModel->find($order['user_id']);
        $order['guitar'] = $guitarModel->find($order['product_id']);
        return view('admin/order', ['order' => $order]);
    }

    public function updateOrderStatus($id)
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/login')->with('error', 'Access denied.');
        }
        $orderModel = new \App\Models\OrderModel();
        $status = $this->request->getPost('status');
        if (!in_array($status, ['Pending', 'Processing', 'Shipped', 'Completed', 'Cancelled'])) {
            return redirect()->to('/admin/order/' . $id)->with('error', 'Invalid status.');
        }
        $orderModel->update($id, ['status' => $status]);
        return redirect()->to('/admin/order/' . $id)->with('success', 'Order status updated.');
    }

    // User Management (for admin)
    public function users()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/login')->with('error', 'Access denied.');
        }
        $userModel = new \App\Models\UserModel();
        $data['users'] = $userModel->findAll();
        return view('admin/users', $data);
    }

    public function deleteUser($id)
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/login')->with('error', 'Access denied.');
        }
        $userModel = new UserModel();
        $userModel->delete($id);
        return redirect()->to('/admin/users');
    }

    public function editUser($id)
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/login')->with('error', 'Access denied.');
        }
        $userModel = new \App\Models\UserModel();
        $user = $userModel->find($id);
        if (!$user) {
            return redirect()->to('/admin/users')->with('error', 'User not found.');
        }
        return view('admin/edit_user', ['user' => $user]);
    }

    public function updateUser($id)
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/login')->with('error', 'Access denied.');
        }
        $userModel = new \App\Models\UserModel();
        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'role' => $this->request->getPost('role'),
        ];
        $userModel->update($id, $data);
        return redirect()->to('/admin/users')->with('success', 'User updated successfully.');
    }

}

