import React, {useEffect, useState} from "react";
import ReactJoyride from "react-joyride";
import { router } from "@inertiajs/react";

export default function TutorialGuide({ user, steps }) {
    const [run, setRun] = useState(false);

    useEffect(() => { 
        if(!user.has_seen_tutorial){
            setRun(true); 
    }}, []);

    const handleTutorialEnd = () => {
        setRun(false);

        router.post('/tutorial/complete'); //Route pour enregistrer que le tuto est terminé
    };

    return (
        <><ReactJoyride steps={steps} run={run} continuous showSkipButton showProgress callback={(data) => { if(data.status === 'finished' || data.status === 'skipped') { handleTutorialEnd();} }} styles={{ options: {zIndex: 10000, primaryColor: 'blue'}, }}/>
        </>
    );
}