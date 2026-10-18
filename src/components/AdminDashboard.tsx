import React from 'react';
import {
  Users,
  Package,
  ShoppingCart,
  DollarSign,
  TrendingUp,
  AlertCircle,
  ArrowUpRight,
  ArrowDownRight,
  HardHat
} from 'lucide-react';
import { Card, CardContent, CardHeader, CardTitle } from './ui/card';
import { Button } from './ui/button';
import { Badge } from './ui/badge';

interface StatItem {
  title: string;
  value: string;
  icon: React.ReactNode;
  trend: string;
  color: string;
}

const AdminDashboard = () => {
  const stats: StatItem[] = [
    { title: "Chiffre d'Affaires", value: '45,230€', icon: <DollarSign size={24} />, trend: '+12%', color: 'bg-success bg-opacity-10 text-success' },
    { title: 'Commandes', value: '156', icon: <ShoppingCart size={24} />, trend: '+8%', color: 'bg-primary bg-opacity-10 text-primary' },
    { title: 'Clients', value: '1,240', icon: <Users size={24} />, trend: '+15%', color: 'bg-info bg-opacity-10 text-info' },
    { title: 'Articles Stock', value: '842', icon: <Package size={24} />, trend: '-2%', color: 'bg-orange-50 text-orange-600' },
  ];

  const recentOrders = [
    { id: '#ORD-9821', customer: 'Jean Dupont', status: 'Livré', date: "Aujourd'hui", total: '124.99€' },
    { id: '#ORD-9820', customer: 'Marie Martin', status: 'En cours', date: "Aujourd'hui", total: '45.00€' },
    { id: '#ORD-9819', customer: 'Pierre Lucas', status: 'Expédié', date: 'Hier', total: '89.50€' },
    { id: '#ORD-9818', customer: 'Sophie Morel', status: 'En cours', date: 'Hier', total: '210.00€' },
  ];

  return (
    <div className="container max-w-7xl mx-auto px-4 py-5">
      <div className="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-5 gap-3">
        <div>
          <h1 className="fw-bold mb-1">Tableau de Bord</h1>
          <p className="text-muted mb-0">Bienvenue, voici un aperçu de votre quincaillerie.</p>
        </div>
        <Button className="fw-bold px-4">
          Générer un Rapport
        </Button>
      </div>

      <div className="row g-4 mb-5">
        {stats.map((stat, i) => (
          <div key={i} className="col-12 col-md-6 col-lg-3">
            <Card className="border-0 shadow-sm">
              <CardContent className="p-4">
                <div className="d-flex justify-content-between align-items-start mb-3">
                  <div className={`p-3 rounded-3 ${stat.color}`}>
                    {stat.icon}
                  </div>
                  <div className={`small fw-bold ${stat.trend.startsWith('+') ? 'text-success' : 'text-danger'}`}>
                    {stat.trend}
                    {stat.trend.startsWith('+') ? <ArrowUpRight size={14} className="ms-1" /> : <ArrowDownRight size={14} className="ms-1" />}
                  </div>
                </div>
                <p className="text-muted small fw-bold mb-1">{stat.title}</p>
                <h3 className="fw-bold mb-0">{stat.value}</h3>
              </CardContent>
            </Card>
          </div>
        ))}
      </div>

      <div className="row g-4">
        <div className="col-lg-8">
          <Card className="border-0 shadow-sm overflow-hidden">
            <CardHeader className="d-flex flex-row align-items-center justify-content-between border-bottom p-4">
              <CardTitle className="h5 fw-bold mb-0">Dernières Commandes</CardTitle>
              <Button variant="ghost" size="sm" className="text-orange-600 fw-bold">Voir tout</Button>
            </CardHeader>
            <CardContent className="p-0">
              <div className="table-responsive">
                <table className="table table-hover align-middle mb-0">
                  <thead className="table-light">
                    <tr className="small text-muted text-uppercase fw-bold">
                      <th className="px-4 py-3 border-0">ID Commande</th>
                      <th className="px-4 py-3 border-0">Client</th>
                      <th className="px-4 py-3 border-0">Date</th>
                      <th className="px-4 py-3 border-0">Statut</th>
                      <th className="px-4 py-3 border-0 text-end">Montant</th>
                    </tr>
                  </thead>
                  <tbody>
                    {recentOrders.map((order, i) => (
                      <tr key={i}>
                        <td className="px-4 py-3 fw-bold">{order.id}</td>
                        <td className="px-4 py-3 text-muted">{order.customer}</td>
                        <td className="px-4 py-3 text-muted small">{order.date}</td>
                        <td className="px-4 py-3">
                          <Badge variant={order.status === 'Livré' ? 'secondary' : order.status === 'Expédié' ? 'default' : 'orange'}>
                            {order.status}
                          </Badge>
                        </td>
                        <td className="px-4 py-3 text-end fw-bold">{order.total}</td>
                      </tr>
                    ))}
                  </tbody>
                </table>
              </div>
            </CardContent>
          </Card>
        </div>

        <div className="col-lg-4 d-grid gap-4">
          <Card className="border-0 shadow-sm">
            <CardHeader>
              <CardTitle className="h5 fw-bold d-flex align-items-center gap-2">
                <AlertCircle size={20} className="text-orange-500" />
                Alertes Stocks
              </CardTitle>
            </CardHeader>
            <CardContent className="d-grid gap-3">
              {[
                { name: 'Perceuse DeWalt DCD', stock: '2 restants', severity: 'high' },
                { name: 'Tuyau Cuivre 15mm', stock: '5 restants', severity: 'medium' },
              ].map((item, i) => (
                <div key={i} className="d-flex align-items-center justify-content-between p-3 bg-light rounded-3 border">
                  <div>
                    <p className="fw-bold small mb-0">{item.name}</p>
                    <p className="text-danger small mb-0 fw-bold">{item.stock}</p>
                  </div>
                  <Button size="sm" variant="outline" className="small border-orange-200 text-orange-600">
                    Réappro.
                  </Button>
                </div>
              ))}
            </CardContent>
          </Card>

          <Card className="bg-dark text-white border-0 shadow-lg position-relative overflow-hidden">
            <CardContent className="p-4 position-relative" style={{ zIndex: 1 }}>
              <h4 className="fw-bold mb-3">Besoin d'aide ?</h4>
              <p className="text-light opacity-50 small mb-4">Consultez notre guide administrateur pour optimiser votre gestion.</p>
              <Button className="w-100 fw-bold">
                Lire la Documentation
              </Button>
            </CardContent>
            <div className="position-absolute bottom-0 end-0 opacity-10" style={{ marginRight: '-30px', marginBottom: '-30px' }}>
              <HardHat size={120} />
            </div>
          </Card>
        </div>
      </div>
    </div>
  );
};

export default AdminDashboard;
