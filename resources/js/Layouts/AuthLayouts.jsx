import LogoLoading from '@/Components/LogoLoading';
import TutorialGuide from '@/Components/TutorialGuide';
import { useRevision } from '@/Contexts/RevisionProvider';
import { Link, usePage } from '@inertiajs/react';
import { lazy, Suspense, useEffect, useState } from 'react';
const LazyLoading = lazy(() => import('@/Components/LazyLoading'))


import { createContext, useContext } from 'react';

export const SearchBarContext = createContext();

export const useSearchBar = () => useContext(SearchBarContext);


export default function AuthLayouts({ children }) {
  const { auth, flash } = usePage().props;
  const [showDropdown, setShowDropdown] = useState(false);
  const [searchKeyword, setSearchKeyword] = useState('');
  const [showMobileMenu, setShowMobileMenu] = useState(false);
  const [messageSuccess, setMessageSuccess] = useState(flash.success);

  useEffect(() => {
    if (flash?.success) {
      setMessageSuccess(flash.success)
      const timer = setTimeout(() => {
        setMessageSuccess(null);
        window.location.reload();
      }, 3000);
      return () => clearTimeout(timer);
    }
  }, [flash]);

  //Differentes pop up
  const steps = [{ target: '.search-bar', content: 'You can quickly search for a worksheet or quiz by typing a keyword here. This is useful for finding specific content across all your topics.', },
  { target: '.profile', content: 'Access your profile here to change your name, email, or manage your preferences. This is your personal space.', },
  { target: '.nav-sheets', content: 'From this section, you can access all your revision cards. You can edit them, delete them, or create new ones.', },
  { target: '.nav-quiz', content: 'In this section, you\'ll find all your saved quizzes. You can view them, edit them, or create new ones to assess yourself. You can also view all your users\' quizzes.', },
  { target: '.nav-revision', content: 'Access the smart review mode here: the application will automatically suggest the files to review today based on the technique used.', },
  { target: '.nav-history', content: 'View your revision history and past activities here. This helps you track your progress and consistency.', },
  { target: '.nav-chatbot', content: 'If you have any questions or misunderstandings about how the site works, please ask EasyLearning Bot who will answer you.' }
  ]

  return (
    <SearchBarContext.Provider value={searchKeyword}>
      <Suspense fallback={<LogoLoading/>}>
        <LazyLoading>

          <div className="d-flex flex-column vh-100">

            {/* Affichage du tutoriel */}
            <TutorialGuide steps={steps} user={auth.user} />

            {/* Top Navbar (visible always) */}
            <nav className="navbar navbar-expand-lg navbar-dark bg-primary px-3">

              <div className="d-flex flex-grow-1 align-items-center justify-content-between">
                <div className="d-flex gap-2 align-items-center">
                  <button
                    className="navbar-toggler button-menu"
                    type="button"
                    onClick={() => setShowMobileMenu(!showMobileMenu)}
                  >
                    <span className="navbar-toggler-icon"></span>
                  </button>
                  <img
                    style={{ borderRadius: '100%', width: '2em', height: '2em' }}
                    src="/images/icon_app2.png"
                    alt="Application Logo"
                  />
                </div>
                <input
                  type="text"
                  style={{ borderRadius: '5px', width: '400px' }}
                  className="form-control mx-4 d-none d-md-block my-auto search-bar"
                  placeholder="Search..."
                  value={searchKeyword}
                  onChange={(e) => setSearchKeyword(e.target.value)}
                />


                <div className="position-relative ms-auto">
                  <button
                    className="btn btn-light text-dark"
                    onClick={() => setShowDropdown(!showDropdown)}
                  >
                    {auth?.user?.name || 'Invité'}
                  </button>
                  {showDropdown && (
                    <div className="dropdown-menu dropdown-menu-end show"
                      style={{ position: 'absolute', top: 45, left: -125 }}>
                      <Link
                        href="/logout"
                        method="post"
                        as="button"
                        className="dropdown-item"
                      >
                        Se Déconnecter
                      </Link>
                      {auth.user.role === 'admin' && (
                        <Link href={route('admin.users.index')} className="dropdown-item" >
                          👥 Gérer les utilisateurs </Link>)}
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
                <div className="bg-white border-end p-3 d-block d-md-none z-40" style={{ position: 'absolute', left: 0, top: 0, bottom: 0, width: '70vw' }}>
                  <SidebarLinks />
                </div>
              )}

              {/* Main Content */}
              <main className="p-3 py-5 flex-grow-1 overflow-auto p-reduce">
                {messageSuccess && (
                  <div className="alert alert-info flash-messge-success">
                    {messageSuccess}
                  </div>
                )}
                {/* Mobile search bar (only shown on small screen) */}
                <div className="mb-3 d-md-none">
                  <input
                    type="text"
                    className="form-control"
                    style={{ borderRadius: '5px' }}
                    placeholder="Search..."
                    value={searchKeyword}
                    onChange={(e) => setSearchKeyword(e.target.value)}
                  />
                </div>

                {children}
              </main>
            </div>
          </div>
        </LazyLoading>
      </Suspense>


    </SearchBarContext.Provider>
  );
}

// Sidebar Links Component
function SidebarLinks({ reduceSideBar = true }) {
  const { revisionCount } = useRevision()
  const isActive = (url) => {
    return url === window.location.pathname
  }

  return (
    <ul className={`nav flex-column text-uppercase fw-bold ${!reduceSideBar && "reduce-margin-icon-side-bar-ul"}`}>

      {/* <li className="nav-item mb-2">
        <Link href="/" className={`nav-link ${isActive('/') ? 'text-white bg-primary rounded' : 'text-dark'}  px-3 py-1`}>
          <i className="bi bi-house me-2"></i> Home
        </Link>
      </li> */}
      <li className="nav-item mb-2">
        <Link href="/profile" className={`nav-link ${isActive('/profile') ? 'text-white bg-primary rounded' : 'text-dark'}  px-3 py-1`}>
          <i className="bi bi-person me-2 reduce-margin-icon-side-bar profile"></i>{reduceSideBar && 'My account'}
        </Link>
      </li>

      <li className="nav-item mb-2">
        <Link href="/sheets" className={`nav-link ${window.location.pathname.includes('/sheets') && !isActive('/sheets/revision') ? 'text-white bg-primary rounded' : 'text-dark'}  px-3 py-1`}>
          <i className="bi bi-folder2-open me-2 reduce-margin-icon-side-bar nav-sheets"></i>{reduceSideBar && 'My sheets'}
        </Link>
      </li>
      <li className="nav-item mb-2">
        <Link href="/quizzes" className={`nav-link ${window.location.pathname.includes('/quizzes') || window.location.pathname.includes('/questions') ? 'text-white bg-primary rounded' : 'text-dark'}  px-3 py-1`}>
          <i className="bi bi-journal-text me-2 reduce-margin-icon-side-bar nav-quiz"></i>{reduceSideBar && 'My quiz'}
        </Link>
      </li>
      <li className="nav-item mb-2">
        <Link href="/sheets/revision" className={`nav-link ${isActive('/sheets/revision') ? 'text-white bg-primary rounded' : 'text-dark'}  px-3 py-1`}>
          <i className="bi bi-book me-2 reduce-margin-icon-side-bar nav-revision"></i>{reduceSideBar && 'Revision'}
          {revisionCount > 0 && <sup className='position-relative'><span className={`badge bg-info ${!reduceSideBar && "badge-revision"}`}>{revisionCount}</span></sup>}
        </Link>
      </li>
      <li className="nav-item mb-2">
        <Link href="/history" className={`nav-link ${isActive('/history') ? 'text-white bg-primary rounded' : 'text-dark'}  px-3 py-1`}>
          <i className="bi bi-clock-history me-2 reduce-margin-icon-side-bar nav-history"></i>{reduceSideBar && 'My History'}
        </Link>
      </li>
      {/* <li className="nav-item">
        <Link href="/profile" className={`nav-link ${isActive('/profile') ? 'text-white bg-primary rounded' : 'text-dark'}  px-3 py-1`}>
          <i className="bi bi-gear me-2"></i> Settings
        </Link>
      </li> */}

      <li className="nav-item mb-2">
        <Link href={route('chatbot')} className={`nav-link ${isActive('/chatbot') ? 'text-white bg-primary rounded' : 'text-dark'}  px-3 py-1`}>
          <i className="bi bi-robot me-2 reduce-margin-icon-side-bar nav-chatbot"></i>{reduceSideBar && 'Assistant IA'}
        </Link>
      </li>
    </ul>
  );
}
