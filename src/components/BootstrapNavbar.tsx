import React from 'react';
import { Navbar, Container, Nav, Badge, Button } from 'react-bootstrap';
import { ShoppingCart, Hammer, User, Search } from 'lucide-react';
import { Link } from 'react-router-dom';

interface Props {
  onCartClick: () => void;
  cartCount: number;
}

const BootstrapNavbar: React.FC<Props> = ({ onCartClick, cartCount }) => {
  return (
    <Navbar bg="white" expand="lg" sticky="top" className="shadow-sm py-3">
      <Container>
        <Navbar.Brand as={Link} to="/" className="text-orange d-flex align-items-center">
          <Hammer className="me-2" />
          <span>BRICO PRO</span>
        </Navbar.Brand>
        <Navbar.Toggle aria-controls="basic-navbar-nav" />
        <Navbar.Collapse id="basic-navbar-nav">
          <Nav className="me-auto">
            <Nav.Link as={Link} to="/" className="px-3">Accueil</Nav.Link>
            <Nav.Link href="#" className="px-3">Outilage</Nav.Link>
            <Nav.Link href="#" className="px-3">Matériaux</Nav.Link>
            <Nav.Link href="#" className="px-3">Jardin</Nav.Link>
            <Nav.Link href="#" className="px-3">Promotions</Nav.Link>
          </Nav>
          <Nav className="align-items-center">
            <Nav.Link href="#" className="p-2 d-none d-lg-block">
              <Search size={20} />
            </Nav.Link>
            <Nav.Link as={Link} to="/login" className="p-2">
              <User size={20} className="me-1" />
              <span className="d-lg-none">Compte</span>
            </Nav.Link>
            <Button
              variant="link"
              className="p-2 position-relative text-dark nav-link"
              onClick={onCartClick}
              style={{ textDecoration: 'none' }}
            >
              <ShoppingCart size={20} />
              {cartCount > 0 && (
                <Badge pill bg="orange" className="position-absolute top-0 start-75 translate-middle" style={{ fontSize: '0.6rem' }}>
                  {cartCount}
                </Badge>
              )}
            </Button>
          </Nav>
        </Navbar.Collapse>
      </Container>
    </Navbar>
  );
};

export default BootstrapNavbar;
