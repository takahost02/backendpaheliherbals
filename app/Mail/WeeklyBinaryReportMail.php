public function __construct($user, $pdf)
{
    $this->user = $user;
    $this->pdf = $pdf;
}

public function build()
{
    return $this->subject('Your Weekly Binary Income Report')
        ->view('emails.weekly_binary')
        ->attachData($this->pdf, 'weekly-binary-report.pdf');
}
