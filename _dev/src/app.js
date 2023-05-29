import App from "./App";
import { createRoot } from '@wordpress/element';
jQuery(function () {



    const prefix = coquardcyrarticleschedulerapp_data.prefix;

    const statuses = coquardcyrarticleschedulerapp_data.statuses;

    const initial = coquardcyrarticleschedulerapp_data.initial;

    const root = document.getElementById(`${prefix}app`);

    if(root){
        createRoot(root).render(<App prefix={prefix} statuses={statuses} initial={initial} />);
    }
});
