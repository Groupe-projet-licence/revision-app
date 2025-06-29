// import { useState } from 'react';
// import ApplicationLogo from '@/Components/ApplicationLogo';
// import Dropdown from '@/Components/Dropdown';
// import NavLink from '@/Components/NavLink';
// import ResponsiveNavLink from '@/Components/ResponsiveNavLink';
// import { Link } from '@inertiajs/react';

// export default function AuthLayouts({ user, header, children }) {
//     const [showingNavigationDropdown, setShowingNavigationDropdown] = useState(false);

//     return (
//         <div className="min-h-screen bg-gray-100">
//             <nav className="bg-white border-b border-gray-100">
//                 <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
//                     <div className="flex justify-between h-16">
//                         <div className="flex">
//                             <div className="shrink-0 flex items-center">
//                                 <Link href="/">
//                                     <ApplicationLogo className="block h-9 w-auto fill-current text-gray-800" />
//                                 </Link>
//                             </div>

//                             <div className="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
//                                 <NavLink href={route('dashboard')} active={route().current('dashboard')}>
//                                     Dashboard
//                                 </NavLink>
//                             </div>
//                         </div>

//                         <div className="hidden sm:flex sm:items-center sm:ms-6">
//                             <div className="ms-3 relative">
//                                 <Dropdown>
//                                     <Dropdown.Trigger>
//                                         <span className="inline-flex rounded-md">
//                                             <button
//                                                 type="button"
//                                                 className="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
//                                             >
//                                                 {user.name}

//                                                 <svg
//                                                     className="ms-2 -me-0.5 h-4 w-4"
//                                                     xmlns="http://www.w3.org/2000/svg"
//                                                     viewBox="0 0 20 20"
//                                                     fill="currentColor"
//                                                 >
//                                                     <path
//                                                         fillRule="evenodd"
//                                                         d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
//                                                         clipRule="evenodd"
//                                                     />
//                                                 </svg>
//                                             </button>
//                                         </span>
//                                     </Dropdown.Trigger>

//                                     <Dropdown.Content>
//                                         <Dropdown.Link href={route('profile.edit')}>Profile</Dropdown.Link>
//                                         <Dropdown.Link href={route('logout')} method="post" as="button">
//                                             Log Out
//                                         </Dropdown.Link>
//                                     </Dropdown.Content>
//                                 </Dropdown>
//                             </div>
//                         </div>

//                         <div className="-me-2 flex items-center sm:hidden">
//                             <button
//                                 onClick={() => setShowingNavigationDropdown((previousState) => !previousState)}
//                                 className="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
//                             >
//                                 <svg className="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
//                                     <path
//                                         className={!showingNavigationDropdown ? 'inline-flex' : 'hidden'}
//                                         strokeLinecap="round"
//                                         strokeLinejoin="round"
//                                         strokeWidth="2"
//                                         d="M4 6h16M4 12h16M4 18h16"
//                                     />
//                                     <path
//                                         className={showingNavigationDropdown ? 'inline-flex' : 'hidden'}
//                                         strokeLinecap="round"
//                                         strokeLinejoin="round"
//                                         strokeWidth="2"
//                                         d="M6 18L18 6M6 6l12 12"
//                                     />
//                                 </svg>
//                             </button>
//                         </div>
//                     </div>
//                 </div>

//                 <div className={(showingNavigationDropdown ? 'block' : 'hidden') + ' sm:hidden'}>
//                     <div className="pt-2 pb-3 space-y-1">
//                         <ResponsiveNavLink href={route('dashboard')} active={route().current('dashboard')}>
//                             Dashboard
//                         </ResponsiveNavLink>
//                     </div>

//                     <div className="pt-4 pb-1 border-t border-gray-200">
//                         <div className="px-4">
//                             <div className="font-medium text-base text-gray-800">{user.name}</div>
//                             <div className="font-medium text-sm text-gray-500">{user.email}</div>
//                         </div>

//                         <div className="mt-3 space-y-1">
//                             <ResponsiveNavLink href={route('profile.edit')}>Profile</ResponsiveNavLink>
//                             <ResponsiveNavLink method="post" href={route('logout')} as="button">
//                                 Log Out
//                             </ResponsiveNavLink>
//                         </div>
//                     </div>
//                 </div>
//             </nav>

//             {header && (
//                 <header className="bg-white shadow">
//                     <div className="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">{header}</div>
//                 </header>
//             )}

//             <main>{children}</main>
//         </div>
//     );
// }


import { useRevision } from '@/Contexts/RevisionProvider';
import { Link, usePage } from '@inertiajs/react';
import { useState } from 'react';

export default function AuthLayouts({ children }) {
  const { auth } = usePage().props;
  const [showDropdown, setShowDropdown] = useState(false);
  const [searchKeyword, setSearchKeyword] = useState('');
  const [showMobileMenu, setShowMobileMenu] = useState(false);
  console.log('showMobileMenu: ' + showMobileMenu);
  console.log('showDropdown: ' + showDropdown);


  return (
    <div className="d-flex flex-column vh-100">
      {/* Top Navbar (visible always) */}
      <nav className="navbar navbar-expand-lg navbar-dark bg-primary px-3">
        <button
          className="navbar-toggler button-menu"
          type="button"
          onClick={() => setShowMobileMenu(!showMobileMenu)}
        >
          <span className="navbar-toggler-icon"></span>
        </button>

        <div className="d-flex flex-grow-1 align-items-center justify-content-between">
          <input
            type="text"
            style={{borderRadius:'5px', width:'400px'}}
            className="form-control mx-4 d-none d-md-block"
            placeholder="Search..."
            value={searchKeyword}
            onChange={(e) => setSearchKeyword(e.target.value)}
          />
          <div className="position-relative ms-auto">
            <button
              className="btn btn-light text-dark"
              onClick={() => setShowDropdown(!showDropdown)}
            >
              {auth.user.name}
            </button>
            {showDropdown && (
              <div className="dropdown-menu dropdown-menu-end show"
                style={{ position: 'absolute', top: 45, right: -10 }}>
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
        <nav className={`bg-white border-end p-3 d-none d-md-block grow-side-bar ${!showMobileMenu && "reduce-side-bar"}`}>
          <SidebarLinks reduceSideBar={showMobileMenu} />
        </nav>

        {/* Sidebar Mobile Dropdown */}
        {showMobileMenu && (
          <div className="bg-white border-end p-3 d-block d-md-none" style={{ position: 'absolute', left: 0, top: 0, bottom: 0, width: '60vw' }}>
            <SidebarLinks />
          </div>
        )}

        {/* Main Content */}
        <main className="p-3 flex-grow-1 overflow-auto p-reduce">
          {/* Mobile search bar (only shown on small screen) */}
          <div className="mb-3 d-md-none">
            <input
              type="text"
              className="form-control"
              style={{borderRadius:'5px'}}
              placeholder="Search..."
              value={searchKeyword}
              onChange={(e) => setSearchKeyword(e.target.value)}
            />
          </div>

          {children}
        </main>
      </div>
    </div>
  );
}

// Sidebar Links Component
function SidebarLinks({ reduceSideBar = true }) {
  const { revisionCount } = useRevision()
  const isActive = (url) => {
    return url === window.location.pathname
  }

  return (
    <ul className="nav flex-column text-uppercase fw-bold">

      {/* <li className="nav-item mb-2">
        <Link href="/" className={`nav-link ${isActive('/') ? 'text-white bg-primary rounded' : 'text-dark'}  px-3 py-1`}>
          <i className="bi bi-house me-2"></i> Home
        </Link>
      </li> */}
      <li className="nav-item mb-2">
        <Link href="/profile" className={`nav-link ${isActive('/profile') ? 'text-white bg-primary rounded' : 'text-dark'}  px-3 py-1`}>
          <i className="bi bi-person me-2"></i>{reduceSideBar && 'My account'}
        </Link>
        </li>
      
      <li className="nav-item mb-2">
        <Link href="/sheets" className={`nav-link ${window.location.pathname.includes('/sheets') && !isActive('/sheets/revision') ? 'text-white bg-primary rounded' : 'text-dark'}  px-3 py-1`}>
          <i className="bi bi-folder2-open me-2"></i>{reduceSideBar && 'My sheets'}
        </Link>
      </li>
      <li className="nav-item mb-2">
        <Link href="/quizzes" className={`nav-link ${window.location.pathname.includes('/quizzes') ? 'text-white bg-primary rounded' : 'text-dark'}  px-3 py-1`}>
          <i className="bi bi-journal-text me-2"></i>{reduceSideBar && 'My quiz'}
        </Link>
      </li>
      <li className="nav-item mb-2">
        <Link href="/sheets/revision" className={`nav-link ${isActive('/sheets/revision') ? 'text-white bg-primary rounded' : 'text-dark'}  px-3 py-1`}>
          <i className="bi bi-book me-2"></i>{reduceSideBar && 'Revision'}
          {revisionCount > 0 && <sup><span className={`badge bg-danger ${!reduceSideBar && "badge-revision"}`}>{revisionCount}</span></sup>}
        </Link>
      </li>
      <li className="nav-item mb-2">
        <Link href="/historique" className={`nav-link ${isActive('/historique') ? 'text-white bg-primary rounded' : 'text-dark'}  px-3 py-1`}>
          <i className="bi bi-clock-history me-2"></i>{reduceSideBar && 'My History'}
        </Link>
      </li> 
      {/* <li className="nav-item">
        <Link href="/profile" className={`nav-link ${isActive('/profile') ? 'text-white bg-primary rounded' : 'text-dark'}  px-3 py-1`}>
          <i className="bi bi-gear me-2"></i> Settings
        </Link>
      </li> */}
    </ul>
  );
}
