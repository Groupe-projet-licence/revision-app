import { Link, usePage } from '@inertiajs/react';
import { useState } from 'react';

export default function AuthLayouts({ children }) {
  const { auth } = usePage().props;
  const [showDropdown, setShowDropdown] = useState(false);
  const [showMobileMenu, setShowMobileMenu] = useState(false);

  return (
    <div className="d-flex flex-column vh-100">
      {/* Top Navbar (visible always) */}
      <nav className="navbar navbar-expand-lg navbar-dark bg-primary px-3">
        <button
          className="navbar-toggler"
          type="button"
          onClick={() => setShowMobileMenu(!showMobileMenu)}
        >
          <span className="navbar-toggler-icon"></span>
        </button>

        <div className="d-flex flex-grow-1 align-items-center justify-content-between">
          <input
            type="text"
            className="form-control mx-3 d-none d-md-block w-50"
            placeholder="Rechercher..."
          />
          <div className="position-relative">
            <button
              className="btn btn-light text-dark"
              onClick={() => setShowDropdown(!showDropdown)}
            >
              {auth.user.name}
            </button>
            {showDropdown && (
              <div className="dropdown-menu dropdown-menu-end show mt-2">
                <Link
                  href="/logout"
                  method="post"
                  as="button"
                  className="dropdown-item"
                >
                  Se Déconnecter
                </Link>
              </div>
            )}
          </div>
        </div>
      </nav>

      {/* Sidebar (mobile = dropdown, desktop = fixed) */}
      <div className="d-flex flex-grow-1">
        {/* Sidebar Desktop */}
        <nav className="bg-white border-end p-3 d-none d-md-block" style={{ width: '250px' }}>
          <SidebarLinks />
        </nav>

        {/* Sidebar Mobile Dropdown */}
        {showMobileMenu && (
          <div className="bg-white border-bottom p-3 d-block d-md-none w-100">
            <SidebarLinks />
          </div>
        )}

        {/* Main Content */}
        <main className="p-4 bg-light flex-grow-1 overflow-auto">
          {/* Mobile search bar (only shown on small screen) */}
          <div className="mb-3 d-md-none">
            <input
              type="text"
              className="form-control"
              placeholder="Rechercher..."
            />
          </div>

          {children}
        </main>
      </div>
    </div>
  );
}

// Sidebar Links Component
function SidebarLinks() {
  return (
    <ul className="nav flex-column text-uppercase fw-bold">
      <li className="nav-item mb-2">
        <Link href="/" className="nav-link text-dark">
          <i className="bi bi-house me-2"></i> Accueil
        </Link>
      </li>
      <li className="nav-item mb-2">
        <Link href="/compte" className="nav-link text-dark">
          <i className="bi bi-person me-2"></i> Mon Compte
        </Link>
      </li>
      <li className="nav-item mb-2">
        <Link href="/sheets" className="nav-link text-white bg-primary rounded px-3 py-1">
          <i className="bi bi-folder2-open me-2"></i> Mes Fiches
        </Link>
      </li>
      <li className="nav-item mb-2">
        <Link href="/quizz" className="nav-link text-dark">
          <i className="bi bi-journal-text me-2"></i> Quizz
        </Link>
      </li>
      <li className="nav-item mb-2">
        <Link href="/revision" className="nav-link text-dark">
          <i className="bi bi-book me-2"></i> Mode Révision
        </Link>
      </li>
      <li className="nav-item mb-2">
        <Link href="/historique" className="nav-link text-dark">
          <i className="bi bi-clock-history me-2"></i> Mon Historique
        </Link>
      </li>
      <li className="nav-item">
        <Link href="/parametres" className="nav-link text-dark">
          <i className="bi bi-gear me-2"></i> Paramètres
        </Link>
      </li>
    </ul>
  );
}
