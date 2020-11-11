import { ToastProgrammatic } from 'buefy';
import { ColorModifiers, GlobalPositions } from 'buefy/types/helpers';
import AbstractNotification from './AbstractNotification';

export default class Toast extends AbstractNotification {
  protected open(
    message: string,
    duration: number = this.defaultSuccessDuration,
    position: GlobalPositions = this.defaultSuccessPosition,
    type: ColorModifiers = this.defaultSuccessType
  ) {
    ToastProgrammatic.open({
      duration,
      message: Toast.translate(message),
      position,
      type,
    });
  }

  public success(message: string = this.defaultSuccessMessage): void {
    this.open(message);
  }
}
