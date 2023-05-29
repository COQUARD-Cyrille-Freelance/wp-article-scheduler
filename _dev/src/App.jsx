import React from 'react'
import {useMemo, useState} from "@wordpress/element";
import {CustomSelectControl, Dropdown, PanelRow, Popover, SlotFillProvider} from '@wordpress/components';
import DateTimePickerField from "./DateTimePickerField";
import {__, _x} from "@wordpress/i18n";
import DateTimePickerToggle from "./DateTimePickerToggle";
import {dateI18n, format, getSettings, gmdateI18n} from "@wordpress/date";

function App({prefix = '', statuses = [], initial, ...props}) {
    const [ date, setDate ] = useState(initial.date);
    const [ status, setStatus ] = useState(initial.status);
    const [ popoverAnchor, setPopoverAnchor ] = useState( null );

    const popoverProps = useMemo(
        () => ( { anchor: popoverAnchor, placement: 'bottom-end', animate: false, } ),
        [ popoverAnchor ]
    );

    const label = date ? format(
        // translators: If using a space between 'g:i' and 'a', use a non-breaking space.
        _x( 'F j, Y g:i\xa0a', 'post schedule full date format' ),
        date
    ) : __('No schedule');

    const value = statuses.find(item => item.key === status) ?? null;

    return <SlotFillProvider>
        <PanelRow>
            <span>{ __('Status') }</span>
            <CustomSelectControl options={statuses} __experimentalShowSelectedHint value={value} onChange={item => setStatus(item.selectedItem.key)} />
            <input type="hidden" name={`${prefix}status`} value={status}/>
        </PanelRow>
        <PanelRow
            ref={ setPopoverAnchor }
        >
            <span>{ __( 'Publish' ) }</span>
            <Dropdown
                popoverProps={ popoverProps }
                contentClassName="edit-post-post-schedule__dialog"
                focusOnMount
                renderToggle={ ( { isOpen, onToggle } ) => (
                    <DateTimePickerToggle isOpen={isOpen} onClick={onToggle} label={label} fullLabel={label}/>
                ) }
                renderContent={ ( { onClose } ) => (
                    <DateTimePickerField value={date} onChange={date => setDate(date)} onClose={onClose} onClick={() => setDate(null)}/>
                ) }
            />
        <div style={{position: 'fixed', width: '100vw'}}>
            <Popover.Slot/>
        </div>
            <input type="hidden" name={`${prefix}change_date`} value={format('Y-m-d h:m', date).replace(' ', 'T')}/>
        </PanelRow>
    </SlotFillProvider>;
}

export default App;
