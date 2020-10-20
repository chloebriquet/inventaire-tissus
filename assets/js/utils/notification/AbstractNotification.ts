import {ColorModifiers, GlobalPositions} from 'buefy/types/helpers';
import i18n from '../i18n';

export default abstract class AbstractNotification {
    protected defaultSuccessMessage: string = 'common.notification.success.creation';
    protected defaultSuccessDuration: number = 3000;
    protected defaultSuccessPosition: GlobalPositions = 'is-top';
    protected defaultSuccessType: ColorModifiers = 'is-info';

    protected defaultErrorMessage: string = 'common.notification.error.creation';
    protected defaultErrorDuration: number = 5000;
    protected defaultErrorPosition: GlobalPositions = 'is-bottom';
    protected defaultErrorType: ColorModifiers = 'is-danger';

    protected translate(message: string): string {
        return i18n.t(message).toString();
    }
}
