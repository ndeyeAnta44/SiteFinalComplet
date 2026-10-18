import React, { useState } from 'react';
import { useAuth } from '../../context/AuthContext';
import { Button } from '../ui/button';
import { Input } from '../ui/input';
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from '../ui/card';
import { LogIn, Mail, Lock, Loader2 } from 'lucide-react';
import { Link, useNavigate } from 'react-router-dom';

export const LoginForm: React.FC = () => {
  const { login } = useAuth();
  const navigate = useNavigate();
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [isSubmitting, setIsSubmitting] = useState(false);

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    setIsSubmitting(true);
    try {
      await login({ email, password });
      navigate('/');
    } catch (error) {
      console.error(error);
    } finally {
      setIsSubmitting(false);
    }
  };

  return (
    <div className="d-flex align-items-center justify-content-center min-vh-75 px-3">
      <Card className="w-100 shadow-lg" style={{ maxWidth: '400px' }}>
        <CardHeader className="text-center">
          <CardTitle className="h3 fw-bold">Connexion</CardTitle>
          <CardDescription>
            Entrez vos identifiants pour accéder à votre compte
          </CardDescription>
        </CardHeader>
        <form onSubmit={handleSubmit}>
          <CardContent className="d-grid gap-3">
            <div className="d-grid gap-2">
              <label className="form-label small fw-bold text-muted mb-0">Email</label>
              <div className="position-relative">
                <Mail className="position-absolute start-0 top-50 translate-middle-y ms-3 text-muted" size={16} />
                <Input
                  id="email"
                  type="email"
                  placeholder="nom@exemple.com"
                  className="ps-5 py-2"
                  value={email}
                  onChange={(e) => setEmail(e.target.value)}
                  required
                />
              </div>
            </div>
            <div className="d-grid gap-2">
              <div className="d-flex align-items-center justify-content-between">
                <label className="form-label small fw-bold text-muted mb-0">Mot de passe</label>
                <Link to="#" className="small text-orange-600 text-decoration-none">Mot de passe oublié ?</Link>
              </div>
              <div className="position-relative">
                <Lock className="position-absolute start-0 top-50 translate-middle-y ms-3 text-muted" size={16} />
                <Input
                  id="password"
                  type="password"
                  className="ps-5 py-2"
                  value={password}
                  onChange={(e) => setPassword(e.target.value)}
                  required
                />
              </div>
            </div>
          </CardContent>
          <CardFooter className="d-grid gap-3 pb-4">
            <Button type="submit" className="w-100 py-2 fw-bold" disabled={isSubmitting}>
              {isSubmitting ? (
                <>
                  <Loader2 size={16} className="me-2 animate-spin" />
                  Connexion...
                </>
              ) : (
                <>
                  <LogIn size={16} className="me-2" />
                  Se connecter
                </>
              )}
            </Button>
            <div className="text-center small">
              Pas encore de compte ?{' '}
              <Link to="/register" className="text-orange-600 fw-bold text-decoration-none">S'inscrire</Link>
            </div>
          </CardFooter>
        </form>
      </Card>
    </div>
  );
};
