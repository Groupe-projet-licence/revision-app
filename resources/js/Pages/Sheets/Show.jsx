/**
 * Fiche de révision à afficher
 * @param {{title: string, description:string, content:string}} sheet 
 */

import SheetModal from "@/Components/SheetModal";
import ShowContentQuill from "@/Components/ShowContentQuill";
import AuthLayouts from "@/Layouts/AuthLayouts";
import { Head, router } from "@inertiajs/react";
import { useEffect, useState } from "react";

export default function Show({ sheet }) {
    const [showModal, setShowModal] = useState(false);
    const [nextVisit, setNextVisit] = useState(null);
    const [navigationBlocked, setNavigationBlocked] = useState(true);

    useEffect(() => {
        const isToday = (new Date().toISOString().slice(0, 10) === sheet.last_opened_at)
        if (!isToday) {

            const cancelNavigation = router.on("before", (event) => {
                if (!navigationBlocked) return;
                event.preventDefault();
                setNextVisit(event.detail.visit);
                setShowModal(true);
                setNavigationBlocked(false);
            });

            return () => cancelNavigation();
        }
    }, [navigationBlocked]);

    const handleStay = () => {
        setShowModal(false);
        setNextVisit(null);
        setNavigationBlocked(true);
    };

    const handleLeave = () => {
        setShowModal(false);
        if (nextVisit) router.visit(nextVisit.url, nextVisit);
    };

    return (
        <AuthLayouts>
            <Head>
                <title>Sheets</title>
            </Head>

            <div>
                <SheetModal
                    isOpen={showModal}
                    cancel={handleStay}
                    navigate={handleLeave}
                    sheet={sheet}
                    disableNavigationBlock={() => setNavigationBlocked(false)}
                />
            </div>

            <div>
                <ShowContentQuill>{sheet.content}</ShowContentQuill>
            </div>
        </AuthLayouts>
    );
}
