import { useRevision } from '@/Contexts/RevisionProvider';
import { Link, usePage } from '@inertiajs/react';
import { useState } from 'react';

export default function AuthLayouts({ children }) {
  const { auth } = usePage().props;
  const [showDropdown, setShowDropdown] = useState(false);
  const [searchKeyword, setSearchKeyword] = useState('');
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
            value= {searchKeyword}
            onChange={ (e) => setSearchKeyword(e.target.value)}
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
      <div className="d-flex flex-grow-1" style={{ position: 'relative' }}>
        {/* Sidebar Desktop */}
        <nav className="bg-white border-end p-3 d-none d-md-block" style={{ minWidth: '250px' }}>
          <SidebarLinks />
        </nav>

        {/* Sidebar Mobile Dropdown */}
        {showMobileMenu && (
          <div className="bg-white border-end p-3 d-block d-md-none" style={{ position: 'absolute', left: 0, top: 0, bottom: 0, width: '85%' }}>
            <SidebarLinks />
          </div>
        )}

        {/* Main Content */}
        <main className="p-4 flex-grow-1 overflow-auto">
          {/* Mobile search bar (only shown on small screen) */}
          <div className="mb-3 d-md-none">
            <input
              type="text"
              className="form-control"
              placeholder="Search..."
              value={searchKeyword}
              onChange={(e) => setSearchKeyword(e.target.value)}
            />
          </div>
          
          {typeof children === 'function' ? children(searchKeyword) : children}
        </main>
      </div>
    </div>
  );
}

// Sidebar Links Component
function SidebarLinks() {
  const { revisionCount } = useRevision()
  const isActive = (url) => {
    return url === window.location.pathname
  }

  return (
    <ul className="nav flex-column text-uppercase fw-bold">
      <li className="nav-item mb-2">
        <Link href="/" className={`nav-link ${isActive('/') ? 'text-white bg-primary rounded' : 'text-dark'}  px-3 py-1`}>
          <i className="bi bi-house me-2"></i> Home
        </Link>
      </li>
      <li className="nav-item mb-2">
        <Link href="/compte" className={`nav-link ${isActive('/compte') ? 'text-white bg-primary rounded' : 'text-dark'}  px-3 py-1`}>
          <i className="bi bi-person me-2"></i> My account
        </Link>
      </li>
      <li className="nav-item mb-2">
        <Link href="/sheets" className={`nav-link ${window.location.pathname.includes('/sheets') && !isActive('/sheets/revision') ? 'text-white bg-primary rounded' : 'text-dark'}  px-3 py-1`}>
          <i className="bi bi-folder2-open me-2"></i> My sheets
        </Link>
      </li>
      <li className="nav-item mb-2">
        <Link href="/quizzes" className={`nav-link ${window.location.pathname.includes('/quizzes') ? 'text-white bg-primary rounded' : 'text-dark'}  px-3 py-1`}>
          <i className="bi bi-journal-text me-2"></i> My quiz
        </Link>
      </li>
      <li className="nav-item mb-2">
        <Link href="/sheets/revision" className={`nav-link ${isActive('/sheets/revision') ? 'text-white bg-primary rounded' : 'text-dark'}  px-3 py-1`}>
          <i className="bi bi-book me-2">
          </i>Review{revisionCount > 0 && <sup><span className="badge bg-danger ms-2">{revisionCount}</span></sup>}
        </Link>
      </li>
      <li className="nav-item mb-2">
        <Link href="/historique" className={`nav-link ${isActive('/historique') ? 'text-white bg-primary rounded' : 'text-dark'}  px-3 py-1`}>
          <i className="bi bi-clock-history me-2"></i> My History
        </Link>
      </li>
      <li className="nav-item">
        <Link href="/parametres" className={`nav-link ${isActive('/parametres') ? 'text-white bg-primary rounded' : 'text-dark'}  px-3 py-1`}>
          <i className="bi bi-gear me-2"></i> Settings
        </Link>
      </li>
    </ul>
  );
}
