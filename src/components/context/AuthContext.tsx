import React, { createContext, useContext, useState, useEffect } from 'react';
import { User, LoginCredentials, RegisterCredentials } from '../types';
import { toast } from 'sonner';

interface AuthContextType {
  user: User | null;
  token: string | null;
  isAuthenticated: boolean;
  isLoading: boolean;
  login: (credentials: LoginCredentials) => Promise<void>;
  register: (credentials: RegisterCredentials) => Promise<void>;
  logout: () => void;
}

const AuthContext = createContext<AuthContextType | undefined>(undefined);

export const AuthProvider: React.FC<{ children: React.ReactNode }> = ({ children }) => {
  const [user, setUser] = useState<User | null>(null);
  const [token, setToken] = useState<string | null>(localStorage.getItem('auth_token'));
  const [isLoading, setIsLoading] = useState(true);

  useEffect(() => {
    const checkAuth = async () => {
      if (token) {
        try {
          // In a real app, verify token with backend
          // const response = await fetch('/api/user', {
          //   headers: { Authorization: `Bearer ${token}` }
          // });
          // if (response.ok) {
          //   const userData = await response.json();
          //   setUser(userData);
          // } else {
          //   logout();
          // }

          // Mocking verification for now since we don't have a live backend
          const savedUser = localStorage.getItem('user');
          if (savedUser) {
            setUser(JSON.parse(savedUser));
          }
        } catch (error) {
          console.error('Auth check failed', error);
          logout();
        }
      }
      setIsLoading(false);
    };

    checkAuth();
  }, [token]);

  const login = async (credentials: LoginCredentials) => {
    try {
      // Mock login implementation
      // In production, use: await fetch('/api/login', { method: 'POST', body: JSON.stringify(credentials) })

      const mockUser: User = {
        id: '1',
        name: 'Demo User',
        email: credentials.email,
        role: credentials.email.includes('admin') ? 'admin' : 'user'
      };

      const mockToken = 'mock-jwt-token-' + Math.random().toString(36).substring(7);

      setUser(mockUser);
      setToken(mockToken);
      localStorage.setItem('auth_token', mockToken);
      localStorage.setItem('user', JSON.stringify(mockUser));

      toast.success('Connexion réussie !');
    } catch (error) {
      toast.error('Échec de la connexion. Veuillez vérifier vos identifiants.');
      throw error;
    }
  };

  const register = async (credentials: RegisterCredentials) => {
    try {
      // Mock register implementation
      const mockUser: User = {
        id: Math.random().toString(36).substring(7),
        name: credentials.name,
        email: credentials.email,
        role: 'user'
      };

      const mockToken = 'mock-jwt-token-' + Math.random().toString(36).substring(7);

      setUser(mockUser);
      setToken(mockToken);
      localStorage.setItem('auth_token', mockToken);
      localStorage.setItem('user', JSON.stringify(mockUser));

      toast.success('Inscription réussie ! Bienvenue.');
    } catch (error) {
      toast.error("Échec de l'inscription.");
      throw error;
    }
  };

  const logout = () => {
    setUser(null);
    setToken(null);
    localStorage.removeItem('auth_token');
    localStorage.removeItem('user');
    toast.info('Déconnecté.');
  };

  return (
    <AuthContext.Provider value={{ user, token, isAuthenticated: !!user, isLoading, login, register, logout }}>
      {children}
    </AuthContext.Provider>
  );
};

export const useAuth = () => {
  const context = useContext(AuthContext);
  if (context === undefined) {
    throw new Error('useAuth must be used within an AuthProvider');
  }
  return context;
};
