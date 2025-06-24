import QuillEditor from "@/Components/QuillEditor";
import AuthLayouts from "@/Layouts/AuthLayouts1";

export default function QuizzesIndex() {
    return <AuthLayouts>
        Quizz
        <div className="big-quill big-loader">

            <QuillEditor />
        </div>
        <QuillEditor />

    </AuthLayouts>
}