import React, { useState } from 'react';
import { Link, useNavigate } from 'react-router-dom';
import { ShoppingCart, User, Search, Menu, X, Hammer, LogOut, LayoutDashboard } from 'lucide-react';
import { Button } from './ui/button';
import { useAuth } from '../context/AuthContext';
import { motion, AnimatePresence } from 'framer-motion';

interface NavbarProps {
  onCartClick?: () => void;
  cartCount?: number;
}

const Navbar: React.FC<NavbarProps> = ({ onCartClick, cartCount = 0 }) => {
  const { user, logout } = useAuth();
  const navigate = useNavigate();
  const [isMenuOpen, setIsMenuOpen] = useState(false);

  return (
    <nav className="navbar navbar-expand-lg bg-white border-bottom border-orange-100 shadow-sm sticky-top">
      <div className="container-fluid max-w-7xl mx-auto px-3">
        <div className="d-flex align-items-center justify-content-between w-100">
          {/* Logo */}
          <Link to="/" className="navbar-brand d-flex align-items-center gap-2 group text-decoration-none">
            <div className="bg-orange-500 p-2 rounded-3 transition-all d-flex align-items-center justify-content-center">
              <Hammer className="h-6 w-6 text-white" />
            </div>
            <span className="h4 mb-0 fw-bold bg-gradient-to-r from-orange-600 to-orange-400 bg-clip-text">
              BricoPro
            </span>
          </Link>

          {/* Desktop Search */}
          <div className="d-none d-md-flex flex-grow-1 mx-5" style={{ maxWidth: '400px' }}>
            <div className="position-relative w-100">
              <input
                type="text"
                placeholder="Rechercher un produit, une marque..."
                className="form-control rounded-pill border-0 bg-light px-5 py-2 small"
              />
              <Search className="position-absolute start-0 top-50 translate-middle-y ms-3 text-muted" size={16} />
            </div>
          </div>

          {/* Desktop Icons */}
          <div className="d-none d-md-flex align-items-center gap-3">
            {user?.role === 'admin' && (
              <Button variant="ghost" size="sm" onClick={() => navigate('/admin')} className="text-orange-600">
                <LayoutDashboard size={20} className="me-2" />
                Dashboard
              </Button>
            )}

            <Button
              variant="ghost"
              size="icon"
              className="position-relative"
              onClick={onCartClick}
            >
              <ShoppingCart size={20} />
              {cartCount > 0 && (
                <span className="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-orange-500" style={{ fontSize: '10px' }}>
                  {cartCount}
                </span>
              )}
            </Button>

            {user ? (
              <div className="d-flex align-items-center gap-2">
                <Button variant="ghost" size="sm" onClick={logout} className="text-secondary">
                  <LogOut size={16} className="me-2" />
                  Déconnexion
                </Button>
              </div>
            ) : (
              <Link to="/login">
                <Button variant="default" className="rounded-pill px-4">
                  Connexion
                </Button>
              </Link>
            )}
          </div>

          {/* Mobile menu button */}
          <div className="d-md-none d-flex align-items-center gap-3">
            <button onClick={onCartClick} className="btn btn-link p-0 position-relative text-secondary">
              <ShoppingCart size={24} />
              {cartCount > 0 && (
                <span className="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-orange-500" style={{ fontSize: '10px' }}>
                  {cartCount}
                </span>
              )}
            </button>
            <button onClick={() => setIsMenuOpen(!isMenuOpen)} className="btn btn-link p-0 text-secondary border-0">
              {isMenuOpen ? <X size={24} /> : <Menu size={24} />}
            </button>
          </div>
        </div>
      </div>

      {/* Mobile Navigation */}
      <AnimatePresence>
        {isMenuOpen && (
          <motion.div
            initial={{ opacity: 0, y: -20 }}
            animate={{ opacity: 1, y: 0 }}
            exit={{ opacity: 0, y: -20 }}
            className="d-md-none bg-white border-bottom border-orange-100 w-100 px-3 py-3"
          >
            <div className="d-grid gap-3">
              <div className="position-relative">
                <input
                  type="text"
                  placeholder="Rechercher..."
                  className="form-control rounded-3 border-0 bg-light px-5"
                />
                <Search className="position-absolute start-0 top-50 translate-middle-y ms-3 text-muted" size={16} />
              </div>
              <div className="d-grid gap-2">
                {user?.role === 'admin' && (
                  <Link to="/admin" className="p-2 text-orange-600 fw-bold text-decoration-none" onClick={() => setIsMenuOpen(false)}>Tableau de Bord</Link>
                )}
                <Link to="/" className="p-2 text-dark text-decoration-none" onClick={() => setIsMenuOpen(false)}>Boutique</Link>
                {user ? (
                  <button onClick={() => { logout(); setIsMenuOpen(false); }} className="btn btn-link text-start text-danger text-decoration-none p-2">Déconnexion</button>
                ) : (
                  <Link to="/login" className="p-2 text-orange-600 fw-bold text-decoration-none" onClick={() => setIsMenuOpen(false)}>Se connecter</Link>
                )}
              </div>
            </div>
          </motion.div>
        )}
      </AnimatePresence>
    </nav>
  );
};

export default Navbar;
