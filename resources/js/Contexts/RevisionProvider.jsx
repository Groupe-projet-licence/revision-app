import { createContext, useContext, useState } from 'react';

const RevisionContext = createContext();

export const useRevision = () => useContext(RevisionContext);

export default function RevisionProvider({ children, initialCount }) {
    const [revisionCount, setRevisionCount] = useState(initialCount);

    return (
        <RevisionContext.Provider value={{ revisionCount, setRevisionCount }}>
            {children}
        </RevisionContext.Provider>
    );
};
