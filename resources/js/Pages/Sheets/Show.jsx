/**
 * Fiche de revision a afficher
 * @param {{title: string, description:string, content:string}} sheet 
 * 
 */

import SheetModal from "@/Components/SheetModal";
import ShowContentQuill from "@/Components/ShowContentQuill";
import AuthLayouts from "@/Layouts/AuthLayouts";
import { Head } from "@inertiajs/react";
import { useEffect, useState } from "react";


export default function Show({ sheet }) {
    const [showModal, setShowModal] = useState(false);
    useEffect(() => {
        const handleBeforeunloadEvent = (e) => {
            e.preventDefault();
            setShowModal(true);
        }

        window.addEventListener('popstate', handleBeforeunloadEvent);
        return () => {
            window.removeEventListener('popstate', handleBeforeunloadEvent)
        };
    }, [])
    
    return <AuthLayouts>
        <Head>
            <title>{sheet.title}</title>
        </Head>
        <div>
            <SheetModal
                isOpen={showModal}
                onClose={(e) => setShowModal(false)}
                sheet={sheet}
            />
        </div>
        <div>
            <ShowContentQuill>{sheet.content} </ShowContentQuill>
        </div>
    </AuthLayouts>
}