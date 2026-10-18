import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { ArrowLeft, ChevronRight, CheckCircle2, ShieldCheck, Truck, CreditCard } from 'lucide-react';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { CartItem, ShippingInfo } from '@/types';
import { formatPrice } from '@/lib/utils';
import { motion, AnimatePresence } from 'framer-motion';
import { toast } from 'sonner';

interface CheckoutPageProps {
  cartItems: CartItem[];
  onCompleteOrder: (shippingInfo: ShippingInfo) => void;
}

export const CheckoutPage: React.FC<CheckoutPageProps> = ({ cartItems, onCompleteOrder }) => {
  const navigate = useNavigate();
  const [step, setStep] = useState<1 | 2>(1);
  const [shippingInfo, setShippingInfo] = useState<ShippingInfo>({
    firstName: '',
    lastName: '',
    address: '',
    city: '',
    zipCode: '',
    phone: '',
    email: '',
  });

  const subtotal = cartItems.reduce((acc, item) => acc + item.price * item.quantity, 0);
  const shippingCost = 12.50;
  const total = subtotal + shippingCost;

  const handleNext = (e: React.FormEvent) => {
    e.preventDefault();
    if (step === 1) {
      if (!shippingInfo.address || !shippingInfo.city || !shippingInfo.zipCode) {
        toast.error("Veuillez remplir tous les champs obligatoires.");
        return;
      }
      setStep(2);
    }
  };

  const handlePaymentSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    onCompleteOrder(shippingInfo);
  };

  if (cartItems.length === 0) {
    return (
      <div className="container text-center py-5 mt-5">
        <h2 className="fw-bold mb-4">Votre panier est vide</h2>
        <Button onClick={() => navigate('/')}>Retour à la boutique</Button>
      </div>
    );
  }

  return (
    <div className="container max-w-7xl mx-auto px-4 py-5">
      <div className="d-flex align-items-center gap-2 mb-4 text-muted">
        <Button variant="ghost" size="sm" onClick={() => navigate(-1)} className="d-flex align-items-center gap-2">
          <ArrowLeft size={16} /> Panier
        </Button>
        <ChevronRight size={14} />
        <span className={step >= 1 ? "fw-bold text-orange-600" : ""}>Livraison</span>
        <ChevronRight size={14} />
        <span className={step === 2 ? "fw-bold text-orange-600" : ""}>Paiement</span>
      </div>

      <div className="row g-4">
        <div className="col-lg-8">
          <AnimatePresence mode="wait">
            {step === 1 ? (
              <motion.div
                key="step1"
                initial={{ opacity: 0, x: -20 }}
                animate={{ opacity: 1, x: 0 }}
                exit={{ opacity: 0, x: 20 }}
              >
                <Card className="border-0 shadow-sm">
                  <CardHeader>
                    <CardTitle className="d-flex align-items-center gap-2">
                      <Truck className="text-orange-600" size={20} />
                      Informations de livraison
                    </CardTitle>
                  </CardHeader>
                  <CardContent>
                    <form onSubmit={handleNext} className="d-grid gap-3">
                      <div className="row g-3">
                        <div className="col-md-6">
                          <label className="form-label small fw-bold">Prénom</label>
                          <Input 
                            required 
                            placeholder="Jean" 
                            value={shippingInfo.firstName}
                            onChange={e => setShippingInfo({...shippingInfo, firstName: e.target.value})}
                          />
                        </div>
                        <div className="col-md-6">
                          <label className="form-label small fw-bold">Nom</label>
                          <Input 
                            required 
                            placeholder="Dupont" 
                            value={shippingInfo.lastName}
                            onChange={e => setShippingInfo({...shippingInfo, lastName: e.target.value})}
                          />
                        </div>
                      </div>
                      <div>
                        <label className="form-label small fw-bold">Adresse</label>
                        <Input 
                          required 
                          placeholder="123 Rue de la Quincaillerie" 
                          value={shippingInfo.address}
                          onChange={e => setShippingInfo({...shippingInfo, address: e.target.value})}
                        />
                      </div>
                      <div className="row g-3">
                        <div className="col-md-6">
                          <label className="form-label small fw-bold">Ville</label>
                          <Input 
                            required 
                            placeholder="Paris" 
                            value={shippingInfo.city}
                            onChange={e => setShippingInfo({...shippingInfo, city: e.target.value})}
                          />
                        </div>
                        <div className="col-md-6">
                          <label className="form-label small fw-bold">Code Postal</label>
                          <Input 
                            required 
                            placeholder="75001" 
                            value={shippingInfo.zipCode}
                            onChange={e => setShippingInfo({...shippingInfo, zipCode: e.target.value})}
                          />
                        </div>
                      </div>
                      <div className="row g-3">
                        <div className="col-md-6">
                          <label className="form-label small fw-bold">Téléphone</label>
                          <Input 
                            required 
                            type="tel" 
                            placeholder="06 12 34 56 78" 
                            value={shippingInfo.phone}
                            onChange={e => setShippingInfo({...shippingInfo, phone: e.target.value})}
                          />
                        </div>
                        <div className="col-md-6">
                          <label className="form-label small fw-bold">Email</label>
                          <Input 
                            required 
                            type="email" 
                            placeholder="jean@exemple.com" 
                            value={shippingInfo.email}
                            onChange={e => setShippingInfo({...shippingInfo, email: e.target.value})}
                          />
                        </div>
                      </div>
                      <Button type="submit" className="w-100 py-3 mt-3 fw-bold">
                        Continuer vers le paiement
                      </Button>
                    </form>
                  </CardContent>
                </Card>
              </motion.div>
            ) : (
              <motion.div
                key="step2"
                initial={{ opacity: 0, x: -20 }}
                animate={{ opacity: 1, x: 0 }}
                exit={{ opacity: 0, x: 20 }}
              >
                <Card className="border-0 shadow-sm">
                  <CardHeader>
                    <CardTitle className="d-flex align-items-center gap-2">
                      <ShieldCheck className="text-success" size={20} />
                      Paiement Sécurisé
                    </CardTitle>
                  </CardHeader>
                  <CardContent>
                    <div className="alert alert-success d-flex gap-3 mb-4">
                      <ShieldCheck size={20} className="flex-shrink-0" />
                      <p className="mb-0 small">Vos transactions sont cryptées et sécurisées. Nous ne stockons pas vos données bancaires.</p>
                    </div>

                    <form onSubmit={handlePaymentSubmit} className="d-grid gap-3">
                      <div>
                        <label className="form-label small fw-bold">Nom sur la carte</label>
                        <Input required placeholder="JEAN DUPONT" />
                      </div>
                      <div>
                        <label className="form-label small fw-bold">Numéro de carte</label>
                        <div className="position-relative">
                          <Input required placeholder="0000 0000 0000 0000" />
                        </div>
                      </div>
                      <div className="row g-3">
                        <div className="col-6">
                          <label className="form-label small fw-bold">Date d'expiration</label>
                          <Input required placeholder="MM / YY" />
                        </div>
                        <div className="col-6">
                          <label className="form-label small fw-bold">CVC</label>
                          <Input required placeholder="123" />
                        </div>
                      </div>
                      
                      <div className="pt-4 border-top mt-3">
                        <div className="d-flex align-items-center gap-2 text-muted mb-4 small">
                          <Truck size={16} />
                          <span>Livraison à: {shippingInfo.address}, {shippingInfo.city}</span>
                          <Button variant="ghost" size="sm" onClick={() => setStep(1)} className="text-orange-600 p-0">Modifier</Button>
                        </div>
                        <Button type="submit" className="w-100 py-3 fw-bold d-flex align-items-center justify-content-center gap-2">
                          <CreditCard size={20} />
                          Payer {formatPrice(total)}
                        </Button>
                      </div>
                    </form>
                  </CardContent>
                </Card>
              </motion.div>
            )}
          </AnimatePresence>
        </div>

        <div className="col-lg-4">
          <Card className="border-0 shadow-sm sticky-top" style={{ top: '100px' }}>
            <CardHeader>
              <CardTitle>Résumé de la commande</CardTitle>
            </CardHeader>
            <CardContent>
              <div className="d-grid gap-3">
                {cartItems.map(item => (
                  <div key={item.id} className="d-flex gap-3 align-items-center">
                    <img src={item.image} alt={item.name} className="rounded-3 object-fit-cover" style={{ width: '60px', height: '60px' }} />
                    <div className="flex-grow-1">
                      <h6 className="fw-bold mb-0 small text-truncate" style={{ maxWidth: '150px' }}>{item.name}</h6>
                      <p className="small text-muted mb-0">Qté: {item.quantity}</p>
                      <p className="small fw-bold mb-0">{formatPrice(item.price * item.quantity)}</p>
                    </div>
                  </div>
                ))}

                <div className="pt-3 border-top d-grid gap-2">
                  <div className="d-flex justify-content-between text-muted small">
                    <span>Sous-total</span>
                    <span>{formatPrice(subtotal)}</span>
                  </div>
                  <div className="d-flex justify-content-between text-muted small">
                    <span>Livraison</span>
                    <span>{formatPrice(shippingCost)}</span>
                  </div>
                  <div className="d-flex justify-content-between h5 fw-bold text-dark pt-2 border-top">
                    <span>Total</span>
                    <span>{formatPrice(total)}</span>
                  </div>
                </div>
              </div>
            </CardContent>
          </Card>
        </div>
      </div>
    </div>
  );
};