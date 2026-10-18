import React from 'react';
import { X, Trash2, Plus, Minus, CreditCard } from 'lucide-react';
import { Button } from './ui/button';
import { CartItem } from '@/types';
import { formatPrice } from '@/lib/utils';
import { motion, AnimatePresence } from 'framer-motion';

interface CartProps {
  isOpen: boolean;
  onClose: () => void;
  items: CartItem[];
  onUpdateQuantity: (id: string, delta: number) => void;
  onRemove: (id: string) => void;
  onCheckout: () => void;
}

export const Cart: React.FC<CartProps> = ({
  isOpen,
  onClose,
  items,
  onUpdateQuantity,
  onRemove,
  onCheckout
}) => {
  const subtotal = items.reduce((acc, item) => acc + (item.price * item.quantity), 0);
  const shipping = items.length > 0 ? 9.99 : 0;
  const total = subtotal + shipping;

  return (
    <AnimatePresence>
      {isOpen && (
        <>
          <motion.div
            initial={{ opacity: 0 }}
            animate={{ opacity: 1 }}
            exit={{ opacity: 0 }}
            className="position-fixed top-0 start-0 w-100 h-100 bg-dark bg-opacity-50 backdrop-blur-sm"
            style={{ zIndex: 1050 }}
            onClick={onClose}
          />
          <motion.div
            initial={{ x: '100%' }}
            animate={{ x: 0 }}
            exit={{ x: '100%' }}
            transition={{ type: 'spring', damping: 25, stiffness: 200 }}
            className="position-fixed top-0 end-0 h-100 bg-white shadow-lg d-flex flex-column"
            style={{ zIndex: 1060, width: '100%', maxWidth: '400px' }}
          >
            <div className="p-4 border-bottom d-flex align-items-center justify-content-between">
              <h4 className="fw-bold mb-0">Votre Panier</h4>
              <Button variant="ghost" size="icon" onClick={onClose}>
                <X size={24} />
              </Button>
            </div>

            <div className="flex-grow-1 overflow-auto p-4 d-grid gap-4">
              {items.length === 0 ? (
                <div className="h-100 d-flex flex-column align-items-center justify-content-center text-muted">
                  <div className="bg-light p-4 rounded-circle mb-3">
                    <Trash2 size={32} className="opacity-25" />
                  </div>
                  <p className="mb-0">Votre panier est vide</p>
                </div>
              ) : (
                items.map((item) => (
                  <div key={item.id} className="d-flex gap-3 align-items-center">
                    <img src={item.image} alt={item.name} className="rounded-3 object-fit-cover" style={{ width: '80px', height: '80px' }} />
                    <div className="flex-grow-1">
                      <div className="d-flex justify-content-between">
                        <h6 className="fw-bold mb-1">{item.name}</h6>
                        <button
                          className="btn btn-link p-0 text-muted hover-text-danger"
                          onClick={() => onRemove(item.id)}
                        >
                          <Trash2 size={16} />
                        </button>
                      </div>
                      <p className="small text-muted mb-2">{formatPrice(item.price)}</p>
                      <div className="d-inline-flex align-items-center border rounded-3 overflow-hidden">
                        <button
                          className="btn btn-sm btn-light border-0 rounded-0 px-2"
                          onClick={() => onUpdateQuantity(item.id, -1)}
                        >
                          <Minus size={12} />
                        </button>
                        <span className="px-3 small fw-bold">{item.quantity}</span>
                        <button
                          className="btn btn-sm btn-light border-0 rounded-0 px-2"
                          onClick={() => onUpdateQuantity(item.id, 1)}
                        >
                          <Plus size={12} />
                        </button>
                      </div>
                    </div>
                  </div>
                ))
              )}
            </div>

            {items.length > 0 && (
              <div className="p-4 bg-light border-top d-grid gap-3">
                <div className="d-grid gap-2">
                  <div className="d-flex justify-content-between text-muted small">
                    <span>Sous-total</span>
                    <span>{formatPrice(subtotal)}</span>
                  </div>
                  <div className="d-flex justify-content-between text-muted small">
                    <span>Livraison</span>
                    <span>{formatPrice(shipping)}</span>
                  </div>
                  <div className="d-flex justify-content-between h5 fw-bold text-dark pt-2 border-top">
                    <span>Total</span>
                    <span>{formatPrice(total)}</span>
                  </div>
                </div>
                <Button className="w-100 py-3 rounded-4 shadow-lg" onClick={onCheckout}>
                  <CreditCard size={20} className="me-2" /> Passer la commande
                </Button>
              </div>
            )}
          </motion.div>
        </>
      )}
    </AnimatePresence>
  );
};
