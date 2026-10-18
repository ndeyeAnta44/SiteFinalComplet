import React from 'react';
import { useNavigate } from 'react-router-dom';
import { CheckCircle2, ArrowRight, Package, Mail } from 'lucide-react';
import { Button } from '@/components/ui/button';
import { motion } from 'framer-motion';

export const SuccessPage: React.FC = () => {
  const navigate = useNavigate();
  const orderNumber = Math.random().toString(36).substring(7).toUpperCase();

  return (
    <div className="container py-5 d-flex align-items-center justify-content-center min-vh-75">
      <motion.div
        initial={{ opacity: 0, scale: 0.9 }}
        animate={{ opacity: 1, scale: 1 }}
        className="text-center w-100" style={{ maxWidth: '500px' }}
      >
        <div className="position-relative d-inline-block mb-4">
          <div className="bg-success bg-opacity-25 rounded-circle p-4 border border-8 border-white shadow-lg">
            <CheckCircle2 size={64} className="text-success" />
          </div>
        </div>

        <div className="mb-5">
          <h1 className="display-5 fw-bold mb-3">Commande Confirmée !</h1>
          <p className="lead text-muted">
            Merci pour votre achat. Votre commande <span className="fw-bold text-dark">#{orderNumber}</span> est en cours de préparation.
          </p>
        </div>

        <img
          src="https://storage.googleapis.com/dala-prod-public-storage/generated-images/942eaeb5-515d-43eb-8221-5333bebb7716/checkout-success-f6bd57ef-1774546846193.webp"
          alt="Success Illustration"
          className="img-fluid rounded-4 shadow-sm mb-5" style={{ maxWidth: '300px' }}
        />

        <div className="row g-3 mb-5">
          <div className="col-sm-6">
            <div className="bg-light p-3 rounded-4 d-flex align-items-center gap-3 text-start border">
              <div className="bg-white p-2 rounded-3 shadow-sm"><Package size={20} className="text-orange-600" /></div>
              <div>
                <p className="small text-muted mb-0">Statut</p>
                <p className="small fw-bold mb-0 text-dark">En préparation</p>
              </div>
            </div>
          </div>
          <div className="col-sm-6">
            <div className="bg-light p-3 rounded-4 d-flex align-items-center gap-3 text-start border">
              <div className="bg-white p-2 rounded-3 shadow-sm"><Mail size={20} className="text-orange-600" /></div>
              <div>
                <p className="small text-muted mb-0">Confirmation</p>
                <p className="small fw-bold mb-0 text-dark">Envoyée par email</p>
              </div>
            </div>
          </div>
        </div>

        <div className="d-flex flex-column flex-sm-row gap-3">
          <Button
            className="flex-grow-1 py-3 fw-bold"
            onClick={() => navigate('/')}
          >
            Continuer mes achats <ArrowRight size={20} className="ms-2" />
          </Button>
          <Button
            variant="outline"
            className="flex-grow-1 py-3 fw-bold"
            onClick={() => navigate('/')}
          >
            Suivre ma commande
          </Button>
        </div>
      </motion.div>
    </div>
  );
};
