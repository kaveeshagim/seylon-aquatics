import { Dismiss } from 'flowbite';

function dismissAlert(targetId, triggerId) {
    const $targetEl = document.getElementById(targetId);
    const $triggerEl = document.getElementById(triggerId);

    const options = {
        transition: 'transition-opacity',
        duration: 300,
        timing: 'ease-out',
        onHide: (context, targetEl) => {
            console.log('Alert dismissed');
            console.log(targetEl);
        }
    };

    const instanceOptions = {
        id: targetId,
        override: true
    };

    const dismiss = new Dismiss($targetEl, $triggerEl, options, instanceOptions);
    dismiss.hide();
}

export default dismissAlert;
