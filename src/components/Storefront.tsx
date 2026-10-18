import React from 'react';
import { motion } from 'framer-motion';
import {
  ChevronRight,
  Wrench,
  Lightbulb,
  Droplets,
  HardHat,
  TrendingUp,
  Truck,
  ShieldCheck,
  Clock,
  Star,
  ShoppingBag,
  ArrowRight
} from 'lucide-react';
import { Button } from './ui/button';
import { Card, CardContent } from './ui/card';
import { Badge } from './ui/badge';

const Storefront = () => {
  const categories = [
    { name: 'Outillage', icon: <Wrench size={20} />, img: 'https://storage.googleapis.com/dala-prod-public-storage/generated-images/942eaeb5-515d-43eb-8221-5333bebb7716/power-tools-97778f14-1774549852246.webp' },
    { name: 'Électricité', icon: <Lightbulb size={20} />, img: 'https://storage.googleapis.com/dala-prod-public-storage/generated-images/942eaeb5-515d-43eb-8221-5333bebb7716/supplies-5c002691-1774549853806.webp' },
    { name: 'Plomberie', icon: <Droplets size={20} />, img: 'https://images.unsplash.com/photo-1581244277943-fe4a9c777189?auto=format&fit=crop&q=80&w=400' },
    { name: 'Équipement', icon: <HardHat size={20} />, img: 'https://storage.googleapis.com/dala-prod-public-storage/generated-images/942eaeb5-515d-43eb-8221-5333bebb7716/store-interior-57862c20-1774549846718.webp' },
  ];

  const products = [
    { id: 1, name: 'Perceuse à Percussion 18V', price: 129.99, category: 'Outillage', rating: 4.8, reviews: 124, img: 'https://images.unsplash.com/photo-1504148455328-c376907d081c?auto=format&fit=crop&q=80&w=400' },
    { id: 2, name: 'Kit Complet Plomberie', price: 89.50, category: 'Plomberie', rating: 4.5, reviews: 89, img: 'https://images.unsplash.com/photo-1621905252507-b35492ee748e?auto=format&fit=crop&q=80&w=400' },
    { id: 3, name: 'Pack Électricien Pro', price: 156.00, category: 'Électricité', rating: 4.9, reviews: 215, img: 'https://images.unsplash.com/photo-1621905251918-48416bd8575a?auto=format&fit=crop&q=80&w=400' },
    { id: 4, name: "Meuleuse d'angle 2000W", price: 75.00, category: 'Outillage', rating: 4.7, reviews: 67, img: 'https://images.unsplash.com/photo-1572981779307-38b8cabb2407?auto=format&fit=crop&q=80&w=400' },
  ];

  return (
    <div className="d-flex flex-column gap-5 pb-5 w-100 overflow-hidden">
      {/* Hero Section */}
      <section className="position-relative w-100 overflow-hidden" style={{ height: '650px' }}>
        <motion.div
          initial={{ scale: 1.1 }}
          animate={{ scale: 1 }}
          transition={{ duration: 10, ease: "linear" }}
          className="position-absolute top-0 start-0 w-100 h-100"
        >
          <img
            src="https://storage.googleapis.com/dala-prod-public-storage/generated-images/942eaeb5-515d-43eb-8221-5333bebb7716/modern-hardware-store-hero-5119e876-1774550985683.webp"
            alt="Modern Hardware Store Hero"
            className="w-100 h-100 object-fit-cover"
          />
        </motion.div>

        <div className="position-absolute top-0 start-0 w-100 h-100 bg-dark" style={{ opacity: 0.4 }} />

        <div className="container position-relative h-100 d-flex flex-column justify-content-center align-items-start text-white max-w-7xl mx-auto px-4">
          <motion.div
            initial={{ opacity: 0, y: 30 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.8, delay: 0.2 }}
            className="max-w-xl"
          >
            <div className="d-flex align-items-center gap-2 mb-4">
              <Badge variant="orange" className="rounded-pill px-3 py-1 text-uppercase fw-bold shadow-lg">
                Nouveauté 2024
              </Badge>
              <div className="bg-orange-600 opacity-50 d-none d-sm-block" style={{ height: '1px', width: '3rem' }}></div>
              <span className="text-orange-400 fw-medium small d-none d-sm-block">Équipement Professionnel</span>
            </div>

            <h1 className="display-2 fw-bold mb-4">
              Tout pour vos <br />
              <span className="bg-gradient-to-r from-orange-600 to-orange-400 bg-clip-text">
                Projets de Rénovation
              </span>
            </h1>

            <p className="lead text-light opacity-75 mb-5">
              De l'outillage de précision aux matériaux de construction, nous équipons les professionnels et les passionnés depuis plus de 30 ans.
            </p>

            <div className="d-flex flex-wrap gap-3">
              <Button size="lg" className="rounded-4 px-4 py-3 shadow-lg">
                <ShoppingBag size={20} className="me-2" />
                Découvrir le catalogue
              </Button>
              <Button variant="outline" size="lg" className="rounded-4 px-4 py-3 bg-white bg-opacity-10 border-white text-white backdrop-blur-md">
                Nos promotions
                <ArrowRight size={20} className="ms-2" />
              </Button>
            </div>

            <div className="mt-5 d-flex align-items-center gap-3 small text-light opacity-75">
              <div className="d-flex align-items-center gap-2">
                <div className="d-flex text-orange-500">
                  {[...Array(5)].map((_, i) => <Star key={i} size={16} fill="currentColor" />)}
                </div>
                <span className="fw-bold text-white">4.9/5</span>
                <span>(12k+ clients satisfaits)</span>
              </div>
            </div>
          </motion.div>
        </div>
      </section>

      {/* Trust Badges */}
      <section className="container max-w-7xl mx-auto px-4" style={{ marginTop: '-4rem' }}>
        <div className="row g-4">
          {[
            { icon: <Truck size={24} className="text-orange-500" />, title: 'Livraison Express', desc: 'En 24/48h chez vous' },
            { icon: <ShieldCheck size={24} className="text-orange-500" />, title: 'Garantie Totale', desc: '2 ans sur tout le stock' },
            { icon: <Clock size={24} className="text-orange-500" />, title: 'Support Expert', desc: 'Des pros vous conseillent' },
            { icon: <TrendingUp size={24} className="text-orange-500" />, title: 'Prix Directs', desc: 'Le meilleur rapport qualité/prix' },
          ].map((badge, i) => (
            <div key={i} className="col-12 col-md-3">
              <motion.div
                whileHover={{ y: -5 }}
                className="d-flex align-items-center gap-3 p-4 rounded-4 bg-white shadow-sm"
              >
                <div className="p-3 bg-orange-50 rounded-4">{badge.icon}</div>
                <div>
                  <h6 className="fw-bold mb-0">{badge.title}</h6>
                  <p className="small text-muted mb-0">{badge.desc}</p>
                </div>
              </motion.div>
            </div>
          ))}
        </div>
      </section>

      {/* Categories */}
      <section className="container max-w-7xl mx-auto px-4 mt-5">
        <div className="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4 gap-3">
          <div>
            <h2 className="fw-bold mb-2">Nos Univers</h2>
            <p className="text-muted mb-0">Le meilleur de l'équipement sélectionné par nos experts.</p>
          </div>
          <Button variant="ghost" className="text-orange-600 fw-bold rounded-3">
            Tout explorer <ChevronRight size={20} className="ms-2" />
          </Button>
        </div>
        <div className="row g-4">
          {categories.map((cat, i) => (
            <div key={i} className="col-12 col-sm-6 col-lg-3">
              <motion.div
                whileHover={{ y: -8 }}
                className="position-relative rounded-4 overflow-hidden shadow-sm" style={{ height: '300px', cursor: 'pointer' }}
              >
                <img
                  src={cat.img}
                  alt={cat.name}
                  className="position-absolute top-0 start-0 w-100 h-100 object-fit-cover transition-transform"
                  style={{ transition: 'transform 0.5s ease' }}
                />
                <div className="position-absolute top-0 start-0 w-100 h-100" style={{ background: 'linear-gradient(to top, rgba(0,0,0,0.8), transparent)' }} />
                <div className="position-absolute bottom-0 start-0 p-4 w-100">
                  <div className="bg-orange-600 rounded-3 p-2 mb-2 d-inline-flex text-white">
                    {cat.icon}
                  </div>
                  <h4 className="text-white fw-bold mb-1">{cat.name}</h4>
                  <p className="text-white opacity-75 small mb-0">DÉCOUVRIR <ChevronRight size={12} /></p>
                </div>
              </motion.div>
            </div>
          ))}
        </div>
      </section>

      {/* Featured Products */}
      <section className="container max-w-7xl mx-auto px-4 mt-5">
        <div className="d-flex align-items-center gap-3 mb-4">
          <div className="bg-orange-500 rounded-pill" style={{ width: '6px', height: '40px' }}></div>
          <h2 className="fw-bold mb-0">Produits Phares</h2>
        </div>

        <div className="row g-4">
          {products.map((product) => (
            <div key={product.id} className="col-12 col-sm-6 col-lg-3">
              <Card className="h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                <div className="position-relative" style={{ aspectRatio: '4/5' }}>
                  <img
                    src={product.img}
                    alt={product.name}
                    className="w-100 h-100 object-fit-cover"
                  />
                  <div className="position-absolute top-0 start-0 p-3">
                    <Badge variant="orange" className="rounded-3 text-uppercase small">{product.category}</Badge>
                  </div>
                  <button className="btn bg-white bg-opacity-75 rounded-3 shadow position-absolute bottom-0 end-0 m-3 d-flex align-items-center justify-content-center" style={{ width: '48px', height: '48px' }}>
                    <ShoppingBag size={20} className="text-orange-600" />
                  </button>
                </div>
                <CardContent className="p-4">
                  <div className="d-flex align-items-center gap-2 mb-2">
                    <div className="d-flex text-orange-500">
                      {[...Array(5)].map((_, i) => (
                        <Star key={i} size={12} fill={i < Math.floor(product.rating) ? 'currentColor' : 'none'} className={i < Math.floor(product.rating) ? '' : 'text-muted'} />
                      ))}
                    </div>
                    <span className="small text-muted">({product.reviews})</span>
                  </div>
                  <h5 className="fw-bold text-dark text-truncate mb-3">{product.name}</h5>
                  <div className="d-flex align-items-center justify-content-between">
                    <div>
                      <span className="small text-muted d-block">Prix</span>
                      <span className="h4 fw-bold mb-0">{product.price}€</span>
                    </div>
                    <Button size="icon" variant="secondary" className="rounded-3">
                      <ChevronRight size={24} />
                    </Button>
                  </div>
                </CardContent>
              </Card>
            </div>
          ))}
        </div>
      </section>

      {/* Newsletter */}
      <section className="container max-w-7xl mx-auto px-4 mt-5 mb-5">
        <div className="bg-dark rounded-5 p-5 position-relative overflow-hidden">
          <div className="row align-items-center">
            <div className="col-lg-7 position-relative">
              <h2 className="text-white fw-bold mb-3">Rejoignez la communauté</h2>
              <p className="text-light opacity-75 lead">
                Recevez nos guides de rénovation, nos offres exclusives et -10% sur votre première commande.
              </p>
            </div>
            <div className="col-lg-5">
              <div className="input-group mb-3">
                <input
                  type="email"
                  className="form-control bg-light bg-opacity-10 border-light border-opacity-25 text-white rounded-start-4 p-3"
                  placeholder="Votre email professionnel"
                />
                <Button className="rounded-end-4 px-4">
                  S'inscrire
                </Button>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  );
};

export default Storefront;
