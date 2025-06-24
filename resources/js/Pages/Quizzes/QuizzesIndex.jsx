import QuillEditor from "@/Components/QuillEditor";
import AuthLayouts from "@/Layouts/AuthLayouts1";
import { Link } from "@inertiajs/react";

export default function QuizzesIndex() {
    return <AuthLayouts>
        <div className="text-end">
            <Link className="btn btn-primary mb-4" href='/quizzes/create'> <span className="fs-5">+</span> New quiz</Link>
        </div>

    </AuthLayouts>
}