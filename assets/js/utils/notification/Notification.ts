import AbstractNotification from './AbstractNotification';
import {NotificationProgrammatic} from 'buefy';
import {ColorModifiers, GlobalPositions} from 'buefy/types/helpers';

export default class Notification extends AbstractNotification {
    protected open(
        message: string,
        duration: number = this.defaultSuccessDuration,
        position: GlobalPositions = this.defaultSuccessPosition,
        type: ColorModifiers = this.defaultSuccessType
    ) {
        NotificationProgrammatic.open({
            duration: duration,
            message: this.translate(message),
            position: position,
            type: type
        });
    }

    public success(message: string = this.defaultSuccessMessage): void {
        this.open(message);
    }
    public creationSuccess(): void {
        this.success();
    }
    public deletionSuccess(): void {
        this.success('common.notification.success.deletion');
    }
    public updateSuccess(): void {
        this.success('common.notification.success.update');
    }

    public error(message: string = this.defaultErrorMessage): void {
        this.open(message, this.defaultErrorDuration, this.defaultErrorPosition, this.defaultErrorType);
    }
    public creationError(): void {
        this.error();
    }
    public deletionError(): void {
        this.success('common.notification.error.deletion');
    }
    public updateError(): void {
        this.success('common.notification.error.update');
    }
}
