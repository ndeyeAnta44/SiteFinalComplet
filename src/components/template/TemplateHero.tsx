import React from 'react';
import { motion } from 'framer-motion';
import { ArrowRight } from 'lucide-react';

const TemplateHero: React.FC = () => {
  return (
    <div className="hero-section overflow-hidden position-relative">
      <div className="container">
        <div className="row align-items-center min-vh-50">
          <div className="col-lg-6 mb-5 mb-lg-0">
            <motion.div
              initial={{ opacity: 0, x: -50 }}
              animate={{ opacity: 1, x: 0 }}
              transition={{ duration: 0.8 }}
            >
              <span className="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill fw-bold mb-3 d-inline-block">
                NOUVELLE COLLECTION 2024
              </span>
              <h1 className="display-3 fw-black mb-4 lh-sm">
                Le Style Rencontre la <span className="text-primary">Performance</span>
              </h1>
              <p className="lead text-muted mb-5 pe-lg-5">
                Découvrez notre sélection exclusive d'articles premium conçus pour votre quotidien. Qualité irréprochable et design moderne.
              </p>
              <div className="d-flex gap-3">
                <button className="btn btn-primary btn-lg px-5 py-3 rounded-pill fw-bold d-flex align-items-center gap-2">
                  Acheter Maintenant <ArrowRight size={20} />
                </button>
                <button className="btn btn-outline-dark btn-lg px-5 py-3 rounded-pill fw-bold">
                  Voir Plus
                </button>
              </div>
            </motion.div>
          </div>
          <div className="col-lg-6">
            <motion.div
              initial={{ opacity: 0, scale: 0.8 }}
              animate={{ opacity: 1, scale: 1 }}
              transition={{ duration: 1 }}
              className="position-relative"
            >
              <img
                src="https://storage.googleapis.com/dala-prod-public-storage/generated-images/942eaeb5-515d-43eb-8221-5333bebb7716/hero-banner-ddf9874a-1774555885620.webp"
                alt="Hero"
                className="img-fluid rounded-4 shadow-lg"
              />
              <div className="position-absolute bottom-0 start-0 bg-white p-4 m-4 rounded-4 shadow border-start border-primary border-5 d-none d-md-block">
                <p className="h4 fw-bold mb-1">Jusqu'à -40%</p>
                <p className="small text-muted mb-0">Sur une sélection d'articles tech</p>
              </div>
            </motion.div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default TemplateHero;
