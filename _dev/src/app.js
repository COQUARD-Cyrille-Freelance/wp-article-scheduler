import App from "./App";
import { createRoot } from '@wordpress/element';
jQuery(function () {



    const prefix = coquardcyrwparticleschedulerapp_data.prefix;

    const statuses = coquardcyrwparticleschedulerapp_data.statuses;

    const initial = coquardcyrwparticleschedulerapp_data.initial;

    const root = document.getElementById(`${prefix}app`);

    if(root){
        createRoot(root).render(<App prefix={prefix} statuses={statuses} initial={initial} />);
    }
});
