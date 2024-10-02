import { reactive } from 'vue';

export const toastState = reactive({
    message: '',
    severity: 'info',
    position: 'top-right',
    activate: false,
    key: 0,
});

export function useToast() {
    const showToast = (message, severity = 'info', position = 'top-right') => {
        toastState.message = message;
        toastState.severity = severity;
        toastState.position = position;
        toastState.activate = true;
        toastState.key += 1;
    };

    return {
        showToast,
        toastState,
    };
}
