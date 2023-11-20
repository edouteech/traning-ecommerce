

    <h1>Confirmation d'inscription</h1>

    <p>Confirmer votre mail pour activer votre compte :</p>

    <button href="{{ url('confirmation', $mailData['token']) }}">{{ url('confirmation', $mailData['token']) }}</button>
