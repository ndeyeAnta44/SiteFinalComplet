import React from 'react';
import { ShoppingCart, Star } from 'lucide-react';
import { Product } from '../../types';
import { motion } from 'framer-motion';

interface TemplateProductCardProps {
  product: Product;
  onAddToCart: (product: Product) => void;
}

const TemplateProductCard: React.FC<TemplateProductCardProps> = ({ product, onAddToCart }) => {
  return (
    <motion.div
      className="card h-100"
      initial={{ opacity: 0, y: 20 }}
      whileInView={{ opacity: 1, y: 0 }}
      viewport={{ once: true }}
      transition={{ duration: 0.5 }}
    >
      <div className="product-image-container">
        <span className="badge-new">Nouveau</span>
        <img src={product.image} alt={product.name} />
        <div className="overlay-btn d-flex align-items-center justify-content-center w-100 h-100 position-absolute top-0 start-0 bg-dark bg-opacity-25 opacity-0 transition-opacity">
          <button
            className="btn btn-light rounded-pill px-4 fw-bold shadow"
            onClick={() => onAddToCart(product)}
          >
            Aperçu Rapide
          </button>
        </div>
      </div>
      <div className="card-body d-flex flex-column p-4">
        <div className="d-flex justify-content-between align-items-start mb-2">
          <small className="text-muted text-uppercase fw-bold ls-wide" style={{ fontSize: '0.65rem' }}>Électronique</small>
          <div className="d-flex text-warning">
            <Star size={14} fill="currentColor" />
            <Star size={14} fill="currentColor" />
            <Star size={14} fill="currentColor" />
            <Star size={14} fill="currentColor" />
            <Star size={14} fill="currentColor" />
          </div>
        </div>
        <h5 className="card-title fw-bold mb-3">{product.name}</h5>
        <p className="card-text text-muted small mb-4 flex-grow-1">
          {product.description || "Un produit exceptionnel conçu avec les meilleurs matériaux pour une durabilité maximale."}
        </p>
        <div className="d-flex align-items-center justify-content-between mt-auto">
          <span className="h4 fw-black text-primary mb-0">{product.price.toLocaleString()}€</span>
          <button
            className="btn btn-dark rounded-circle p-2 d-flex align-items-center justify-content-center"
            onClick={() => onAddToCart(product)}
            title="Ajouter au panier"
          >
            <ShoppingCart size={18} />
          </button>
        </div>
      </div>
    </motion.div>
  );
};

export default TemplateProductCard;
