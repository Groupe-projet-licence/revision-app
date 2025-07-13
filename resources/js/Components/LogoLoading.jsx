import { Head } from "@inertiajs/react";

export default function LogoLoading({ }) {
  return <div className="d-flex justify-content-center align-items-center position-relative"
    style={{ background: '#0d6efd', height: '100vh' }}>
      <Head title="Loading"/>

    {/* <span className="position-absolute">
      <img
        style={{ borderRadius: '100%', width:'12em',height:'12em' }}
        src="/images/icon_app2.png"
        alt="Application Logo"
      />
    </span> */}
    <span className="position-absolute" style={{width:'3em', height:'3em', borderRadius:'50%', backgroundColor: 'white'}}></span>

    <div className='spinner-border  text-primary position-absolute' role='status'></div>

  </div>
}
