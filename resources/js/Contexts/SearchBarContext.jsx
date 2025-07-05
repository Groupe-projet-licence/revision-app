import { createContext, useContext, useState } from 'react';

const SearchBarContext = createContext();

export const useSearchBar = () => useContext(SearchBarContext);

