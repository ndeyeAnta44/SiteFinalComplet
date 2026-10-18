import React from 'react';
import { Container, Row, Col, Card, Button, Badge } from 'react-bootstrap';
import { Star, ShoppingCart, ArrowRight } from 'lucide-react';

interface Props {
  onAddToCart: (product: any) => void;
}

const PRODUCTS = [
  {
    id: '1',
    name: 'Perceuse-visseuse à percussion sans fil',
    price: 149.99,
    rating: 4.8,
    reviews: 124,
    image: 'https://storage.googleapis.com/dala-prod-public-storage/generated-images/942eaeb5-515d-43eb-8221-5333bebb7716/power-drill-product-90e3337f-1774553465460.webp',
    category: 'Outillage électroportatif'
  },
  {
    id: '2',
    name: 'Set complet outils à main (120 pièces)',
    price: 89.90,
    rating: 4.5,
    reviews: 86,
    image: 'https://storage.googleapis.com/dala-prod-public-storage/generated-images/942eaeb5-515d-43eb-8221-5333bebb7716/hand-tools-category-f1674dab-1774553465637.webp',
    category: 'Outillage à main'
  },
  {
    id: '3',
    name: "Meuleuse d'angle professionnelle",
    price: 75.00,
    rating: 4.7,
    reviews: 42,
    image: 'https://storage.googleapis.com/dala-prod-public-storage/generated-images/942eaeb5-515d-43eb-8221-5333bebb7716/pro-handyman-service-492d5fdd-1774553459606.webp',
    category: "Machines d'atelier"
  },
  {
    id: '4',
    name: 'Scie circulaire laser 1500W',
    price: 129.00,
    rating: 4.9,
    reviews: 215,
    image: 'https://storage.googleapis.com/dala-prod-public-storage/generated-images/942eaeb5-515d-43eb-8221-5333bebb7716/hardware-store-hero-5ec56d50-1774553459922.webp',
    category: 'Scies'
  }
];

const BootstrapStorefront: React.FC<Props> = ({ onAddToCart }) => {
  return (
    <div>
      {/* Hero Section */}
      <section
        className="hero-section text-center text-white d-flex align-items-center"
        style={{
          backgroundImage: `url('https://storage.googleapis.com/dala-prod-public-storage/generated-images/942eaeb5-515d-43eb-8221-5333bebb7716/hardware-store-hero-5ec56d50-1774553459922.webp')`,
          backgroundSize: 'cover',
          backgroundPosition: 'center',
          height: '500px',
          position: 'relative'
        }}
      >
        <div style={{ position: 'absolute', top: 0, left: 0, right: 0, bottom: 0, backgroundColor: 'rgba(0,0,0,0.5)' }}></div>
        <Container style={{ position: 'relative', zIndex: 2 }}>
          <Badge bg="orange" className="mb-3 px-3 py-2 text-uppercase">Nouveautés 2024</Badge>
          <h1 className="display-3 fw-bold mb-4">L'expert du bricolage, c'est vous.</h1>
          <p className="lead mb-5 px-lg-5">Découvrez notre sélection d'outillage professionnel pour tous vos projets de construction et de rénovation.</p>
          <div className="d-flex justify-content-center gap-3">
            <Button variant="orange" size="lg" className="px-5 py-3">Voir le catalogue</Button>
            <Button variant="light" size="lg" className="px-5 py-3">Nos promotions</Button>
          </div>
        </Container>
      </section>

      {/* Featured Products */}
      <section className="py-5 bg-light">
        <Container>
          <div className="d-flex justify-content-between align-items-end mb-5">
            <div>
              <h2 className="fw-bold mb-0">Meilleures ventes</h2>
              <p className="text-muted">Les outils les plus plébiscités par nos experts.</p>
            </div>
            <Button variant="link" className="text-orange text-decoration-none fw-bold p-0">
              Voir tout <ArrowRight size={18} className="ms-1" />
            </Button>
          </div>

          <Row xs={1} md={2} lg={4} className="g-4">
            {PRODUCTS.map(product => (
              <Col key={product.id}>
                <Card className="h-100 card-product">
                  <div style={{ height: '200px', overflow: 'hidden' }}>
                    <Card.Img
                      variant="top"
                      src={product.image}
                      className="h-100 w-100 object-fit-cover"
                    />
                  </div>
                  <Card.Body className="d-flex flex-column">
                    <div className="mb-2">
                      <small className="text-uppercase text-muted fw-bold" style={{ fontSize: '0.7rem' }}>{product.category}</small>
                    </div>
                    <Card.Title className="h6 fw-bold mb-2 flex-grow-1">{product.name}</Card.Title>
                    <div className="d-flex align-items-center mb-3">
                      <div className="text-warning me-2 d-flex">
                        {[...Array(5)].map((_, i) => (
                          <Star key={i} size={14} fill={i < Math.floor(product.rating) ? "currentColor" : "none"} />
                        ))}
                      </div>
                      <small className="text-muted">({product.reviews})</small>
                    </div>
                    <div className="d-flex justify-content-between align-items-center">
                      <span className="h5 fw-bold mb-0">{product.price.toFixed(2)} €</span>
                      <Button
                        variant="orange"
                        size="sm"
                        className="rounded-circle p-2"
                        onClick={() => onAddToCart(product)}
                      >
                        <ShoppingCart size={18} />
                      </Button>
                    </div>
                  </Card.Body>
                </Card>
              </Col>
            ))}
          </Row>
        </Container>
      </section>

      {/* Categories Grid */}
      <section className="py-5">
        <Container>
          <h2 className="fw-bold mb-5 text-center">Nos univers</h2>
          <Row className="g-4">
            {[
              { title: 'Outillage', img: 'https://storage.googleapis.com/dala-prod-public-storage/generated-images/942eaeb5-515d-43eb-8221-5333bebb7716/hand-tools-category-f1674dab-1774553465637.webp', size: 8 },
              { title: 'Électricité', img: 'https://storage.googleapis.com/dala-prod-public-storage/generated-images/942eaeb5-515d-43eb-8221-5333bebb7716/pro-handyman-service-492d5fdd-1774553459606.webp', size: 4 },
              { title: 'Sanitaire', img: 'https://storage.googleapis.com/dala-prod-public-storage/generated-images/942eaeb5-515d-43eb-8221-5333bebb7716/hardware-store-hero-5ec56d50-1774553459922.webp', size: 4 },
              { title: 'Quincaillerie', img: 'https://storage.googleapis.com/dala-prod-public-storage/generated-images/942eaeb5-515d-43eb-8221-5333bebb7716/power-drill-product-90e3337f-1774553465460.webp', size: 8 }
            ].map((cat, i) => (
              <Col md={cat.size} key={i}>
                <div
                  className="rounded shadow-sm overflow-hidden position-relative"
                  style={{ height: '250px', cursor: 'pointer' }}
                >
                  <img src={cat.img} className="h-100 w-100 object-fit-cover transition-scale" alt={cat.title} />
                  <div className="position-absolute bottom-0 start-0 p-4 w-100" style={{ background: 'linear-gradient(transparent, rgba(0,0,0,0.8))' }}>
                    <h4 className="text-white fw-bold mb-0">{cat.title}</h4>
                    <span className="text-white-50 small">Découvrir l'univers <ArrowRight size={14} /></span>
                  </div>
                </div>
              </Col>
            ))}
          </Row>
        </Container>
      </section>

      {/* Promo Banner */}
      <section className="py-5 mb-5">
        <Container>
          <div className="bg-dark rounded-4 p-5 text-white position-relative overflow-hidden">
            <div className="position-relative z-1">
              <h2 className="display-5 fw-bold mb-3">Service Click & Collect</h2>
              <p className="lead mb-4 col-md-8">Commandez en ligne et récupérez vos articles en magasin en moins de 2 heures. C'est gratuit et rapide !</p>
              <Button variant="orange" size="lg" className="px-5">En savoir plus</Button>
            </div>
          </div>
        </Container>
      </section>
    </div>
  );
};

export default BootstrapStorefront;
