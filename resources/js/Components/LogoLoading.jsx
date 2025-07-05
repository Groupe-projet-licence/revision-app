import ApplicationLogo from '@/Components/ApplicationLogo';

export default function LogoLoading({ }) {
    return <div className="d-flex justify-content-center align-items-center h-100"
        style={{ background: '#0d6efd' }}>
        <ApplicationLogo className="w-20 h-20 fill-current text-gray-500" />
    </div>
}