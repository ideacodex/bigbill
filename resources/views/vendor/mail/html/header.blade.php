<tr>
    <td class="header" align="center" style="background-color: black" width="570" cellpadding="0" cellspacing="0">
        <a href="{{ $url }}" style="display: inline-block;">
            @if (trim($slot) === 'Laravel')
                <img style="width: 80%" class="user-avatar" src="{{ asset('images/logoBB.svg') }}" alt="Big Bill">
            @else
                {{ $slot }}
            @endif
        </a>
    </td>
</tr>
