import {__} from "@wordpress/i18n";
import {Button} from "@wordpress/components";

export default function DateTimePickerToggle({ isOpen, onClick, label, fullLabel }) {
    return <Button
        className="edit-post-post-schedule__toggle"
        variant="tertiary"
        label={ fullLabel }
        showTooltip
        aria-expanded={ isOpen }
        // translators: %s: Current post date.
        aria-label={ sprintf( __( 'Change date: %s' ), label ) }
        onClick={ onClick }
    >
        { label }
    </Button>
}