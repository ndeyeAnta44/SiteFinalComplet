import React from 'react';
import { Package, Globe, Mail, Phone, MapPin } from 'lucide-react';

const TemplateFooter: React.FC = () => {
  return (
    <footer className="template-footer">
      <div className="container">
        <div className="row g-4 mb-5">
          <div className="col-lg-4">
            <div className="d-flex align-items-center mb-4">
              <Package className="text-primary me-2" size={28} />
              <span className="h4 fw-black mb-0 text-white">ORANGE<span className="text-primary">SHOP</span></span>
            </div>
            <p className="text-secondary mb-4">
              Votre destination privilégiée pour les derniers produits tech et lifestyle. Nous nous engageons à vous offrir la meilleure expérience d'achat en ligne.
            </p>
            <div className="d-flex gap-3">
              <a href="#" className="btn btn-outline-secondary rounded-circle p-2"><Globe size={18} /></a>
              <a href="#" className="btn btn-outline-secondary rounded-circle p-2"><Mail size={18} /></a>
            </div>
          </div>
          <div className="col-lg-2 col-md-4">
            <h5 className="fw-bold mb-4 text-white">Boutique</h5>
            <ul className="list-unstyled">
              <li className="mb-2"><a href="#" className="footer-link">Tous les produits</a></li>
              <li className="mb-2"><a href="#" className="footer-link">Nouveautés</a></li>
              <li className="mb-2"><a href="#" className="footer-link">Promotions</a></li>
              <li className="mb-2"><a href="#" className="footer-link">Collections</a></li>
            </ul>
          </div>
          <div className="col-lg-2 col-md-4">
            <h5 className="fw-bold mb-4 text-white">Support</h5>
            <ul className="list-unstyled">
              <li className="mb-2"><a href="#" className="footer-link">Aide & FAQ</a></li>
              <li className="mb-2"><a href="#" className="footer-link">Livraison</a></li>
              <li className="mb-2"><a href="#" className="footer-link">Retours</a></li>
              <li className="mb-2"><a href="#" className="footer-link">Contact</a></li>
            </ul>
          </div>
          <div className="col-lg-4 col-md-4">
            <h5 className="fw-bold mb-4 text-white">Contact</h5>
            <div className="d-flex gap-3 mb-3">
              <MapPin size={20} className="text-primary flex-shrink-0" />
              <p className="text-secondary mb-0">123 Avenue de la Tech, 75000 Paris, France</p>
            </div>
            <div className="d-flex gap-3 mb-3">
              <Phone size={20} className="text-primary flex-shrink-0" />
              <p className="text-secondary mb-0">+33 1 23 45 67 89</p>
            </div>
            <div className="d-flex gap-3">
              <Mail size={20} className="text-primary flex-shrink-0" />
              <p className="text-secondary mb-0">contact@orangeshop.com</p>
            </div>
          </div>
        </div>
        <hr className="border-secondary opacity-25" />
        <div className="row align-items-center py-4">
          <div className="col-md-6">
            <p className="small mb-0 text-secondary">© 2024 OrangeShop. Tous droits réservés.</p>
          </div>
          <div className="col-md-6 text-md-end">
            <div className="d-flex justify-content-md-end gap-3 mt-3 mt-md-0">
              <img src="https://upload.wikimedia.org/wikipedia/commons/5/5e/Visa_Inc._logo.svg" height="15" alt="Visa" />
              <img src="https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg" height="15" alt="Mastercard" />
              <img src="https://upload.wikimedia.org/wikipedia/commons/b/b5/PayPal.svg" height="15" alt="PayPal" />
            </div>
          </div>
        </div>
      </div>
    </footer>
  );
};

export default TemplateFooter;
