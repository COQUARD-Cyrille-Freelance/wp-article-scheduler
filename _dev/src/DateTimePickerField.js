import {DateTimePicker} from "@wordpress/components";
import {__} from "@wordpress/i18n";
import InspectorPopoverHeader from "./InspectorPopoverHeader";
import {getSettings, isInTheFuture} from '@wordpress/date';
export default function DateTimePickerField({onClick = () => {}, onClose = () => {}, value = null, onChange = (date) => {}}) {
    const settings = getSettings();
    // To know if the current timezone is a 12 hour time with look for "a" in the time format
    // We also make sure this a is not escaped by a "/"
    const is12HourTime = /a(?!\\)/i.test(
        settings.formats.time
            .toLowerCase() // Test only the lower case a.
            .replace( /\\\\/g, '' ) // Replace "//" with empty strings.
            .split( '' )
            .reverse()
            .join( '' ) // Reverse the string and test for "a" not followed by a slash.
    );

    return <div className="block-editor-publish-date-time-picker">
                <InspectorPopoverHeader
                    title={__('Schedule')}
                    actions={[
                        {
                            label: __('Cancel'),
                            onClick: () => onClick()
                        }
                    ]}
                    onClose={onClose}
                />
                <DateTimePicker
                    currentDate={value}
                    onChange={date => onChange(date)}
                    is12Hour={ is12HourTime }
                    isInvalidDate={date => ! isInTheFuture(date)}
                />
            </div>;
}