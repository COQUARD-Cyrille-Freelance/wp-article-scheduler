import React from 'react'
import App from "./App";
import {createRoot} from 'react-dom/client';

jQuery(function () {

    const prefix = 'coquardcyr_wp_article_scheduler_';

    const root = document.getElementById(`${prefix}app`);

    if(root){
        createRoot(root).render(<App prefix={prefix} />);
    }
});
