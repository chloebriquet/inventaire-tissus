import { ColorModifiers, GlobalPositions } from 'buefy/types/helpers';
import i18n from '../i18n';

export default abstract class AbstractNotification {
  protected defaultSuccessMessage = 'common.notification.success.creation';

  protected defaultSuccessDuration = 3000;

  protected defaultSuccessPosition: GlobalPositions = 'is-top';

  protected defaultSuccessType: ColorModifiers = 'is-info';

  protected defaultErrorMessage = 'common.notification.error.creation';

  protected defaultErrorDuration = 5000;

  protected defaultErrorPosition: GlobalPositions = 'is-bottom';

  protected defaultErrorType: ColorModifiers = 'is-danger';

  protected static translate(message: string): string {
    return i18n.t(message).toString();
  }
}
