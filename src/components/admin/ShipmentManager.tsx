import React, { useState } from 'react';
import {
  Package,
  Truck,
  CheckCircle2,
  Clock,
  Search,
  Eye,
  MapPin,
  Phone,
  Mail,
  MoreVertical,
  ExternalLink,
  Filter
} from 'lucide-react';
import { Card, CardContent, CardHeader, CardTitle, CardDescription } from '@/components/ui/card';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Badge } from '@/components/ui/badge';
import { Order } from '@/types';
import { formatPrice } from '@/lib/utils';
import { toast } from 'sonner';

const MOCK_ORDERS: Order[] = [
  {
    id: 'ORD-7721',
    userId: '1',
    items: [],
    total: 212.49,
    status: 'processing',
    paymentStatus: 'paid',
    shippingInfo: {
      firstName: 'Jean',
      lastName: 'Dupont',
      address: '12 Rue de la Paix',
      city: 'Paris',
      zipCode: '75001',
      phone: '06 12 34 56 78',
      email: 'jean@exemple.com'
    },
    createdAt: '2024-03-15T10:30:00Z'
  },
  {
    id: 'ORD-7722',
    userId: '2',
    items: [],
    total: 89.99,
    status: 'shipped',
    paymentStatus: 'paid',
    trackingNumber: 'FR-9988776655',
    shippingInfo: {
      firstName: 'Marie',
      lastName: 'Curie',
      address: '45 Avenue des Sciences',
      city: 'Lyon',
      zipCode: '69002',
      phone: '07 89 45 12 23',
      email: 'marie@lab.com'
    },
    createdAt: '2024-03-14T15:45:00Z'
  },
  {
    id: 'ORD-7723',
    userId: '3',
    items: [],
    total: 1299.99,
    status: 'pending',
    paymentStatus: 'unpaid',
    shippingInfo: {
      firstName: 'Albert',
      lastName: 'Einstein',
      address: '7 Boulevard de la Relativité',
      city: 'Marseille',
      zipCode: '13008',
      phone: '04 91 22 33 44',
      email: 'albert@physic.org'
    },
    createdAt: '2024-03-15T14:20:00Z'
  }
];

export const ShipmentManager: React.FC = () => {
  const [orders, setOrders] = useState<Order[]>(MOCK_ORDERS);
  const [searchTerm, setSearchTerm] = useState('');
  const [filter, setFilter] = useState<Order['status'] | 'all'>('all');

  const filteredOrders = orders.filter(order => {
    const matchesSearch = order.id.toLowerCase().includes(searchTerm.toLowerCase()) ||
                          order.shippingInfo.lastName.toLowerCase().includes(searchTerm.toLowerCase());
    const matchesFilter = filter === 'all' || order.status === filter;
    return matchesSearch && matchesFilter;
  });

  const updateOrderStatus = (id: string, newStatus: Order['status']) => {
    setOrders(prev => prev.map(order =>
      order.id === id ? { ...order, status: newStatus } : order
    ));
    toast.success(`Statut de la commande ${id} mis à jour : ${newStatus}`);
  };

  const getStatusBadge = (status: Order['status']) => {
    switch (status) {
      case 'pending': return <Badge variant="outline">En attente</Badge>;
      case 'processing': return <Badge variant="orange">En cours</Badge>;
      case 'shipped': return <Badge variant="default">Expédié</Badge>;
      case 'delivered': return <Badge variant="secondary">Livré</Badge>;
      case 'cancelled': return <Badge variant="destructive">Annulé</Badge>;
      default: return <Badge>{status}</Badge>;
    }
  };

  return (
    <div className="d-grid gap-4">
      <div className="row g-3 align-items-center">
        <div className="col-md-8">
          <div className="position-relative">
            <Search size={18} className="position-absolute start-0 top-50 translate-middle-y ms-3 text-muted" />
            <Input
              placeholder="Rechercher par N° de commande ou client..."
              className="ps-5"
              value={searchTerm}
              onChange={(e) => setSearchTerm(e.target.value)}
            />
          </div>
        </div>
        <div className="col-md-4">
          <div className="d-flex align-items-center gap-2">
            <Filter size={18} className="text-muted" />
            <select
              className="form-select"
              value={filter}
              onChange={(e) => setFilter(e.target.value as any)}
            >
              <option value="all">Tous les statuts</option>
              <option value="pending">En attente</option>
              <option value="processing">En cours</option>
              <option value="shipped">Expédié</option>
              <option value="delivered">Livré</option>
            </select>
          </div>
        </div>
      </div>

      <div className="d-grid gap-3">
        {filteredOrders.length === 0 ? (
          <div className="text-center py-5 bg-light rounded-4 border border-dashed">
            <Package size={48} className="text-muted opacity-25 mb-3" />
            <p className="text-muted">Aucune commande trouvée.</p>
          </div>
        ) : (
          filteredOrders.map(order => (
            <Card key={order.id} className="border-0 shadow-sm">
              <CardContent className="p-0">
                <div className="p-4 d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-4 border-bottom">
                  <div>
                    <div className="d-flex align-items-center gap-2 mb-1">
                      <h5 className="fw-bold mb-0">{order.id}</h5>
                      {getStatusBadge(order.status)}
                      {order.paymentStatus === 'paid' ? (
                        <Badge variant="secondary" className="small">Payé</Badge>
                      ) : (
                        <Badge variant="outline" className="small">Non payé</Badge>
                      )}
                    </div>
                    <p className="small text-muted mb-0 d-flex align-items-center gap-2">
                      <Clock size={12} /> Passée le {new Date(order.createdAt).toLocaleDateString('fr-FR', { day: 'numeric', month: 'long', year: 'numeric', hour: '2-digit', minute: '2-digit' })}
                    </p>
                  </div>
                  <div className="d-flex align-items-center gap-3">
                    <div className="text-end d-none d-md-block">
                      <p className="fw-bold text-dark mb-0">{formatPrice(order.total)}</p>
                      <p className="small text-muted mb-0">Total commande</p>
                    </div>
                    <Button variant="outline" size="sm">Détails</Button>
                    <div className="dropdown">
                      <Button variant="ghost" size="icon" className="dropdown-toggle no-caret" data-bs-toggle="dropdown">
                        <MoreVertical size={16} />
                      </Button>
                      <ul className="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-3">
                        <li><button className="dropdown-item small text-orange-600 fw-bold" onClick={() => updateOrderStatus(order.id, 'processing')}>Préparer</button></li>
                        <li><button className="dropdown-item small text-primary fw-bold" onClick={() => updateOrderStatus(order.id, 'shipped')}>Expédier</button></li>
                        <li><button className="dropdown-item small text-success fw-bold" onClick={() => updateOrderStatus(order.id, 'delivered')}>Livrer</button></li>
                        <li><hr className="dropdown-divider" /></li>
                        <li><button className="dropdown-item small text-danger" onClick={() => updateOrderStatus(order.id, 'cancelled')}>Annuler</button></li>
                      </ul>
                    </div>
                  </div>
                </div>

                <div className="p-4">
                  <div className="row g-4">
                    <div className="col-md-4">
                      <h6 className="fw-bold small d-flex align-items-center gap-2 mb-3">
                        <MapPin size={16} className="text-orange-500" /> Adresse
                      </h6>
                      <div className="small text-muted">
                        <p className="fw-bold text-dark mb-1">{order.shippingInfo.firstName} {order.shippingInfo.lastName}</p>
                        <p className="mb-1">{order.shippingInfo.address}</p>
                        <p className="mb-0">{order.shippingInfo.zipCode} {order.shippingInfo.city}</p>
                      </div>
                    </div>
                    <div className="col-md-4">
                      <h6 className="fw-bold small d-flex align-items-center gap-2 mb-3">
                        <Phone size={16} className="text-orange-500" /> Contact
                      </h6>
                      <div className="small text-muted">
                        <p className="mb-1 d-flex align-items-center gap-2"><Phone size={12} /> {order.shippingInfo.phone}</p>
                        <p className="mb-0 d-flex align-items-center gap-2 text-decoration-underline"><Mail size={12} /> {order.shippingInfo.email}</p>
                      </div>
                    </div>
                    <div className="col-md-4">
                      <h6 className="fw-bold small d-flex align-items-center gap-2 mb-3">
                        <Truck size={16} className="text-orange-500" /> Expédition
                      </h6>
                      {order.trackingNumber ? (
                        <div className="bg-light p-2 rounded border d-flex justify-content-between align-items-center">
                          <div>
                            <p className="text-uppercase text-muted" style={{ fontSize: '10px' }}>N° Suivi</p>
                            <p className="font-monospace text-orange-600 fw-bold mb-0">{order.trackingNumber}</p>
                          </div>
                          <ExternalLink size={14} className="text-muted" />
                        </div>
                      ) : (
                        <p className="small text-muted fst-italic">En attente d'expédition...</p>
                      )}
                    </div>
                  </div>
                </div>
              </CardContent>
            </Card>
          ))
        )}
      </div>
    </div>
  );
};
