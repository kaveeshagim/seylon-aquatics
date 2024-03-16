import { Dismiss } from 'flowbite';


export function initializeAlertDismiss(targetElementId, triggerElementId) {
    const $targetEl = targetElementId;
    const $triggerEl = triggerElementId;
  
    const options = {
      transition: 'transition-opacity',
      duration: 1000,
      timing: 'ease-out',
      onHide: (context, targetEl) => {
        console.log('Element has been dismissed');
        console.log(targetEl);
      }
    };
  
    const dismiss = new Dismiss($targetEl, $triggerEl, options);
  
    return dismiss;
  }