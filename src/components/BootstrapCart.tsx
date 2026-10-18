import React from 'react';
import { Offcanvas, ListGroup, Button, Image } from 'react-bootstrap';
import { Trash2, ShoppingBag } from 'lucide-react';

interface Props {
  show: boolean;
  onHide: () => void;
  items: any[];
  onUpdateQuantity: (id: string, delta: number) => void;
  onRemove: (id: string) => void;
}

const BootstrapCart: React.FC<Props> = ({ show, onHide, items, onUpdateQuantity, onRemove }) => {
  const total = items.reduce((acc, item) => acc + item.price * item.quantity, 0);

  return (
    <Offcanvas show={show} onHide={onHide} placement="end">
      <Offcanvas.Header closeButton className="border-bottom">
        <Offcanvas.Title className="fw-bold">
          <ShoppingBag className="me-2 text-orange" />
          Votre Panier ({items.length})
        </Offcanvas.Title>
      </Offcanvas.Header>
      <Offcanvas.Body className="d-flex flex-column">
        {items.length === 0 ? (
          <div className="text-center py-5">
            <ShoppingBag size={64} className="text-muted mb-3 opacity-25" />
            <p className="text-muted">Votre panier est vide</p>
            <Button variant="orange" onClick={onHide}>Continuer mes achats</Button>
          </div>
        ) : (
          <>
            <ListGroup variant="flush" className="flex-grow-1 overflow-auto">
              {items.map((item) => (
                <ListGroup.Item key={item.id} className="py-3 px-0 border-bottom">
                  <div className="d-flex gap-3">
                    <Image src={item.image} rounded style={{ width: '80px', height: '80px', objectFit: 'cover' }} />
                    <div className="flex-grow-1">
                      <h6 className="mb-1 text-truncate" style={{ maxWidth: '180px' }}>{item.name}</h6>
                      <p className="text-orange fw-bold mb-2">{item.price.toFixed(2)} €</p>
                      <div className="d-flex align-items-center justify-content-between">
                        <div className="d-flex align-items-center border rounded">
                          <Button variant="link" size="sm" className="text-dark p-1" onClick={() => onUpdateQuantity(item.id, -1)}>-</Button>
                          <span className="px-2 small fw-bold">{item.quantity}</span>
                          <Button variant="link" size="sm" className="text-dark p-1" onClick={() => onUpdateQuantity(item.id, 1)}>+</Button>
                        </div>
                        <Button variant="link" className="text-danger p-0" onClick={() => onRemove(item.id)}>
                          <Trash2 size={18} />
                        </Button>
                      </div>
                    </div>
                  </div>
                </ListGroup.Item>
              ))}
            </ListGroup>
            <div className="mt-auto pt-3 border-top">
              <div className="d-flex justify-content-between h5 fw-bold mb-4">
                <span>Total</span>
                <span>{total.toFixed(2)} €</span>
              </div>
              <Button variant="orange" className="w-100 py-3 fw-bold rounded-3">
                Valider la commande
              </Button>
            </div>
          </>
        )}
      </Offcanvas.Body>
    </Offcanvas>
  );
};

export default BootstrapCart;
