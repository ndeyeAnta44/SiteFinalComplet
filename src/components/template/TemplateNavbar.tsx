import React from 'react';
import { ShoppingCart, User, Search, Menu, Package } from 'lucide-react';
import { useAuth } from '../../context/AuthContext';
import { Link } from 'react-router-dom';

interface TemplateNavbarProps {
  cartCount: number;
  onCartClick: () => void;
  onAdminClick: () => void;
}

const TemplateNavbar: React.FC<TemplateNavbarProps> = ({ cartCount, onCartClick, onAdminClick }) => {
  const { user, logout } = useAuth();

  return (
    <nav className="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm py-3">
      <div className="container">
        <Link className="navbar-brand d-flex align-items-center text-decoration-none" to="/">
          <Package className="text-primary me-2" size={28} />
          <span className="text-dark">ORANGE<span className="text-primary">SHOP</span></span>
        </Link>

        <button className="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <Menu size={24} />
        </button>

        <div className="collapse navbar-collapse" id="navbarNav">
          <ul className="navbar-nav mx-auto">
            <li className="nav-item">
              <Link className="nav-link px-3 fw-medium" to="/">Boutique</Link>
            </li>
            <li className="nav-item">
              <a className="nav-link px-3 fw-medium" href="#">Catégories</a>
            </li>
            <li className="nav-item">
              <a className="nav-link px-3 fw-medium" href="#">Promotions</a>
            </li>
            <li className="nav-item">
              <a className="nav-link px-3 fw-medium" href="#">À Propos</a>
            </li>
          </ul>

          <div className="d-flex align-items-center gap-3">
            <button className="btn btn-link text-dark p-0 border-0">
              <Search size={20} />
            </button>

            <div className="position-relative">
              <button
                className="btn btn-outline-dark border-2 rounded-pill d-flex align-items-center gap-2 px-3 py-1"
                onClick={onCartClick}
              >
                <ShoppingCart size={18} />
                <span className="fw-bold d-none d-md-inline">Panier</span>
                {cartCount > 0 && (
                  <span className="badge bg-primary rounded-circle position-absolute top-0 start-100 translate-middle">
                    {cartCount}
                  </span>
                )}
              </button>
            </div>

            {user ? (
              <div className="dropdown">
                <button
                  className="btn btn-dark rounded-circle p-2 d-flex align-items-center justify-content-center"
                  type="button"
                  data-bs-toggle="dropdown"
                >
                  <User size={18} />
                </button>
                <ul className="dropdown-menu dropdown-menu-end shadow border-0 mt-2">
                  <li className="px-3 py-2 border-bottom">
                    <p className="small mb-0 text-muted">Connecté en tant que</p>
                    <p className="fw-bold mb-0 text-truncate">{user.email}</p>
                  </li>
                  {user.role === 'admin' && (
                    <li><button className="dropdown-item py-2" onClick={onAdminClick}>Tableau de bord</button></li>
                  )}
                  <li><hr className="dropdown-divider" /></li>
                  <li><button className="dropdown-item py-2 text-danger" onClick={logout}>Déconnexion</button></li>
                </ul>
              </div>
            ) : (
              <Link to="/login" className="btn btn-dark rounded-pill px-4">Connexion</Link>
            )}
          </div>
        </div>
      </div>
    </nav>
  );
};

export default TemplateNavbar;
