import * as React from "react";
import { cn } from "@/lib/utils";

export interface BadgeProps extends React.HTMLAttributes<HTMLDivElement> {
  variant?: 'default' | 'secondary' | 'destructive' | 'outline' | 'orange';
}

function Badge({ className, variant = 'default', ...props }: BadgeProps) {
  const variantClasses = {
    default: 'bg-primary text-white',
    secondary: 'bg-secondary text-white',
    destructive: 'bg-danger text-white',
    outline: 'border border-secondary text-secondary',
    orange: 'bg-orange-600 text-white'
  };

  return (
    <div
      className={cn(
        "badge d-inline-flex align-items-center rounded-pill px-2.5 py-0.5 text-xs font-weight-bold transition-all",
        variantClasses[variant],
        className
      )}
      {...props}
    />
  );
}

export { Badge };
