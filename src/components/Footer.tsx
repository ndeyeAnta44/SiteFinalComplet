import React from 'react';
import { Hammer, Globe, Mail, Phone, MapPin, Share2 } from 'lucide-react';
import { Link } from 'react-router-dom';

const Footer = () => {
  const currentYear = new Date().getFullYear();

  return (
    <footer className="bg-dark text-white pt-5 pb-4 mt-auto">
      <div className="container max-w-7xl mx-auto px-4">
        <div className="row g-4 border-bottom border-secondary pb-5 mb-4">
          {/* Company Info */}
          <div className="col-12 col-md-4">
            <Link to="/" className="d-flex align-items-center gap-2 text-decoration-none group mb-4">
              <div className="bg-orange-500 p-2 rounded-3">
                <Hammer className="h-6 w-6 text-white" />
              </div>
              <span className="h4 mb-0 fw-bold text-white">BricoPro</span>
            </Link>
            <p className="text-light opacity-50 small">
              Votre expert en quincaillerie et outillage professionnel depuis 1995. Nous accompagnons les artisans et les particuliers dans tous leurs projets.
            </p>
            <div className="d-flex gap-3">
              <a href="#" className="btn btn-secondary rounded-circle p-2 d-flex align-items-center justify-content-center" style={{ width: '40px', height: '40px' }}><Globe size={18} /></a>
              <a href="#" className="btn btn-secondary rounded-circle p-2 d-flex align-items-center justify-content-center" style={{ width: '40px', height: '40px' }}><Share2 size={18} /></a>
              <a href="#" className="btn btn-secondary rounded-circle p-2 d-flex align-items-center justify-content-center" style={{ width: '40px', height: '40px' }}><Mail size={18} /></a>
            </div>
          </div>

          {/* Quick Links */}
          <div className="col-6 col-md-2">
            <h6 className="fw-bold text-white mb-4">Liens Rapides</h6>
            <ul className="list-unstyled small opacity-75 d-grid gap-2">
              <li><Link to="/" className="text-white text-decoration-none hover:text-orange-500 transition-colors">Accueil</Link></li>
              <li><Link to="/" className="text-white text-decoration-none hover:text-orange-500 transition-colors">Tous les produits</Link></li>
              <li><Link to="/" className="text-white text-decoration-none hover:text-orange-500 transition-colors">Promotions</Link></li>
            </ul>
          </div>

          {/* Categories */}
          <div className="col-6 col-md-2">
            <h6 className="fw-bold text-white mb-4">Catégories</h6>
            <ul className="list-unstyled small opacity-75 d-grid gap-2">
              <li><a href="#" className="text-white text-decoration-none hover:text-orange-500 transition-colors">Outillage Électroportatif</a></li>
              <li><a href="#" className="text-white text-decoration-none hover:text-orange-500 transition-colors">Plomberie & Chauffage</a></li>
              <li><a href="#" className="text-white text-decoration-none hover:text-orange-500 transition-colors">Électricité & Éclairage</a></li>
            </ul>
          </div>

          {/* Contact */}
          <div className="col-12 col-md-4">
            <h6 className="fw-bold text-white mb-4">Contactez-nous</h6>
            <div className="d-grid gap-3 small opacity-75">
              <div className="d-flex align-items-start gap-3">
                <MapPin className="text-orange-500" size={18} />
                <p className="mb-0">123 Avenue de la République, 75011 Paris, France</p>
              </div>
              <div className="d-flex align-items-center gap-3">
                <Phone className="text-orange-500" size={18} />
                <p className="mb-0">+33 1 23 45 67 89</p>
              </div>
              <div className="d-flex align-items-center gap-3">
                <Mail className="text-orange-500" size={18} />
                <p className="mb-0">contact@bricopro.fr</p>
              </div>
            </div>
          </div>
        </div>

        <div className="d-flex flex-column flex-md-row justify-content-between align-items-center small opacity-50 gap-3">
          <p className="mb-0">© {currentYear} BricoPro Quincaillerie. Tous droits réservés.</p>
          <div className="d-flex gap-4">
            <a href="#" className="text-white text-decoration-none">Mentions Légales</a>
            <a href="#" className="text-white text-decoration-none">Confidentialité</a>
            <a href="#" className="text-white text-decoration-none">CGV</a>
          </div>
        </div>
      </div>
    </footer>
  );
};

export default Footer;
