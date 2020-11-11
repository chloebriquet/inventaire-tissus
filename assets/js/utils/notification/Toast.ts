import AbstractNotification from './AbstractNotification';
import { ToastProgrammatic } from 'buefy';
import { ColorModifiers, GlobalPositions } from 'buefy/types/helpers';

export default class Toast extends AbstractNotification {
    protected open(
        message: string,
        duration: number = this.defaultSuccessDuration,
        position: GlobalPositions = this.defaultSuccessPosition,
        type: ColorModifiers = this.defaultSuccessType
    ) {
        ToastProgrammatic.open({
            duration: duration,
            message: this.translate(message),
            position: position,
            type: type
        });
    }

    public success(message: string = this.defaultSuccessMessage): void {
        this.open(message);
    }
}
