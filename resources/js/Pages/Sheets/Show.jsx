/**
 * Fiche de revision a afficher
 * @param {{title: string, description:string, content:string}} sheet 
 * 
 */

import ShowContentQuill from "@/Components/ShowContentQuill";
import AuthLayouts from "@/Layouts/AuthLayouts";
import { Head } from "@inertiajs/react";


export default function Show({ sheet }) {
    return <AuthLayouts>
        <Head>
            <title>{sheet.title}</title>
        </Head>
        <div>
            <ShowContentQuill>{sheet.content} </ShowContentQuill>
        </div>
    </AuthLayouts>
}