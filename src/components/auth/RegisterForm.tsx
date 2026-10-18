import React, { useState } from 'react';
import { useAuth } from '../../context/AuthContext';
import { Button } from '../ui/button';
import { Input } from '../ui/input';
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from '../ui/card';
import { UserPlus, Mail, Lock, User, Loader2 } from 'lucide-react';
import { Link, useNavigate } from 'react-router-dom';
import { toast } from 'sonner';

export const RegisterForm: React.FC = () => {
  const { register } = useAuth();
  const navigate = useNavigate();
  const [formData, setFormData] = useState({
    name: '',
    email: '',
    password: '',
    confirmPassword: '',
  });
  const [isSubmitting, setIsSubmitting] = useState(false);

  const handleChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    setFormData({ ...formData, [e.target.id]: e.target.value });
  };

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    if (formData.password !== formData.confirmPassword) {
      toast.error('Les mots de passe ne correspondent pas.');
      return;
    }

    setIsSubmitting(true);
    try {
      await register({
        name: formData.name,
        email: formData.email,
        password: formData.password,
        password_confirmation: formData.confirmPassword,
      });
      navigate('/');
    } catch (error) {
      console.error(error);
    } finally {
      setIsSubmitting(false);
    }
  };

  return (
    <div className="d-flex align-items-center justify-content-center min-vh-75 px-3">
      <Card className="w-100 shadow-lg" style={{ maxWidth: '450px' }}>
        <CardHeader className="text-center">
          <CardTitle className="h3 fw-bold">Créer un compte</CardTitle>
          <CardDescription>
            Inscrivez-vous pour commencer vos achats
          </CardDescription>
        </CardHeader>
        <form onSubmit={handleSubmit}>
          <CardContent className="d-grid gap-3">
            <div className="d-grid gap-2">
              <label className="form-label small fw-bold text-muted mb-0">Nom complet</label>
              <div className="position-relative">
                <User className="position-absolute start-0 top-50 translate-middle-y ms-3 text-muted" size={16} />
                <Input
                  id="name"
                  placeholder="Jean Dupont"
                  className="ps-5 py-2"
                  value={formData.name}
                  onChange={handleChange}
                  required
                />
              </div>
            </div>
            <div className="d-grid gap-2">
              <label className="form-label small fw-bold text-muted mb-0">Email</label>
              <div className="position-relative">
                <Mail className="position-absolute start-0 top-50 translate-middle-y ms-3 text-muted" size={16} />
                <Input
                  id="email"
                  type="email"
                  placeholder="nom@exemple.com"
                  className="ps-5 py-2"
                  value={formData.email}
                  onChange={handleChange}
                  required
                />
              </div>
            </div>
            <div className="d-grid gap-2">
              <label className="form-label small fw-bold text-muted mb-0">Mot de passe</label>
              <div className="position-relative">
                <Lock className="position-absolute start-0 top-50 translate-middle-y ms-3 text-muted" size={16} />
                <Input
                  id="password"
                  type="password"
                  className="ps-5 py-2"
                  value={formData.password}
                  onChange={handleChange}
                  required
                />
              </div>
            </div>
            <div className="d-grid gap-2">
              <label className="form-label small fw-bold text-muted mb-0">Confirmer le mot de passe</label>
              <div className="position-relative">
                <Lock className="position-absolute start-0 top-50 translate-middle-y ms-3 text-muted" size={16} />
                <Input
                  id="confirmPassword"
                  type="password"
                  className="ps-5 py-2"
                  value={formData.confirmPassword}
                  onChange={handleChange}
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
                  Inscription...
                </>
              ) : (
                <>
                  <UserPlus size={16} className="me-2" />
                  S'inscrire
                </>
              )}
            </Button>
            <div className="text-center small">
              Déjà un compte ?{' '}
              <Link to="/login" className="text-orange-600 fw-bold text-decoration-none">Se connecter</Link>
            </div>
          </CardFooter>
        </form>
      </Card>
    </div>
  );
};
