import React, { useState } from 'react';
import { BrowserRouter as Router, Routes, Route, Navigate } from 'react-router-dom';
import BootstrapNavbar from './components/BootstrapNavbar';
import BootstrapFooter from './components/BootstrapFooter';
import BootstrapStorefront from './components/BootstrapStorefront';
import BootstrapCart from './components/BootstrapCart';
import { AuthProvider } from './context/AuthContext';
import { CartItem } from './types';
import 'bootstrap/dist/css/bootstrap.min.css';

function App() {
  const [isCartOpen, setIsCartOpen] = useState(false);
  const [cartItems, setCartItems] = useState<CartItem[]>([]);

  const addToCart = (product: any) => {
    setCartItems(prev => {
      const existing = prev.find(item => item.id === product.id);
      if (existing) {
        return prev.map(item => item.id === product.id ? { ...item, quantity: item.quantity + 1 } : item);
      }
      return [...prev, { ...product, quantity: 1 }];
    });
    setIsCartOpen(true);
  };

  const handleUpdateQuantity = (id: string, delta: number) => {
    setCartItems(prev => prev.map(item =>
      item.id === id ? { ...item, quantity: Math.max(1, item.quantity + delta) } : item
    ));
  };

  const handleRemoveItem = (id: string) => {
    setCartItems(prev => prev.filter(item => item.id !== id));
  };

  return (
    <AuthProvider>
      <Router>
        <div className="d-flex flex-column min-vh-100">
          <BootstrapNavbar onCartClick={() => setIsCartOpen(true)} cartCount={cartItems.reduce((acc, item) => acc + item.quantity, 0)} />

          <main className="flex-grow-1">
            <Routes>
              <Route path="/" element={<BootstrapStorefront onAddToCart={addToCart} />} />
              <Route path="*" element={<Navigate to="/" replace />} />
            </Routes>
          </main>

          <BootstrapCart
            show={isCartOpen}
            onHide={() => setIsCartOpen(false)}
            items={cartItems}
            onUpdateQuantity={handleUpdateQuantity}
            onRemove={handleRemoveItem}
          />

          <BootstrapFooter />
        </div>
      </Router>
      <style>{`
        :root {
          --brico-orange: #FF6600;
          --brico-dark: #333333;
        }
        .bg-orange { background-color: var(--brico-orange) !important; }
        .text-orange { color: var(--brico-orange) !important; }
        .btn-orange { background-color: var(--brico-orange); border-color: var(--brico-orange); color: white; }
        .btn-orange:hover { background-color: #e55c00; border-color: #e55c00; color: white; }
        .navbar-brand { font-weight: 800; font-size: 1.5rem; }
        .card-product { transition: transform 0.3s; border: 1px solid #eee; }
        .card-product:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
      `}</style>
    </AuthProvider>
  );
}

export default App;
