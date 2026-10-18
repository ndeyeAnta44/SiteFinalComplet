import React from 'react';
import { Container, Row, Col } from 'react-bootstrap';
import { Hammer, Globe, Mail, Phone } from 'lucide-react';

const BootstrapFooter: React.FC = () => {
  return (
    <footer className="bg-dark text-white py-5 mt-auto">
      <Container>
        <Row className="gy-4">
          <Col lg={4}>
            <div className="text-orange d-flex align-items-center mb-4">
              <Hammer className="me-2" size={32} />
              <span className="h4 fw-bold mb-0">BRICO PRO</span>
            </div>
            <p className="text-muted mb-4">
              Votre partenaire de confiance pour tous vos travaux depuis 1985. Qualité professionnelle au meilleur prix.
            </p>
            <div className="d-flex gap-3 text-white-50">
              <Globe size={20} />
              <Mail size={20} />
              <Phone size={20} />
            </div>
          </Col>
          <Col sm={6} lg={2} className="offset-lg-1">
            <h6 className="fw-bold mb-4">Boutique</h6>
            <ul className="list-unstyled">
              <li className="mb-2"><a href="#" className="text-white-50 text-decoration-none">Outillage</a></li>
              <li className="mb-2"><a href="#" className="text-white-50 text-decoration-none">Matériaux</a></li>
              <li className="mb-2"><a href="#" className="text-white-50 text-decoration-none">Jardin</a></li>
              <li className="mb-2"><a href="#" className="text-white-50 text-decoration-none">Sanitaire</a></li>
            </ul>
          </Col>
          <Col sm={6} lg={2}>
            <h6 className="fw-bold mb-4">Services</h6>
            <ul className="list-unstyled">
              <li className="mb-2"><a href="#" className="text-white-50 text-decoration-none">Livraison</a></li>
              <li className="mb-2"><a href="#" className="text-white-50 text-decoration-none">Click & Collect</a></li>
              <li className="mb-2"><a href="#" className="text-white-50 text-decoration-none">Location d'outils</a></li>
              <li className="mb-2"><a href="#" className="text-white-50 text-decoration-none">Installation</a></li>
            </ul>
          </Col>
          <Col sm={6} lg={3}>
            <h6 className="fw-bold mb-4">Newsletter</h6>
            <p className="text-white-50 small mb-3">Recevez nos meilleures offres et conseils bricolage.</p>
            <div className="input-group">
              <input type="email" className="form-control bg-transparent border-secondary text-white" placeholder="Votre email" />
              <button className="btn btn-orange" type="button">OK</button>
            </div>
          </Col>
        </Row>
        <hr className="my-5 border-secondary" />
        <div className="d-flex flex-column flex-md-row justify-content-between align-items-center text-white-50 small">
          <p className="mb-0">© 2024 Brico Pro. Tous droits réservés.</p>
          <div className="d-flex gap-4 mt-3 mt-md-0">
            <a href="#" className="text-white-50 text-decoration-none">Mentions légales</a>
            <a href="#" className="text-white-50 text-decoration-none">Confidentialité</a>
            <a href="#" className="text-white-50 text-decoration-none">CGV</a>
          </div>
        </div>
      </Container>
    </footer>
  );
};

export default BootstrapFooter;
