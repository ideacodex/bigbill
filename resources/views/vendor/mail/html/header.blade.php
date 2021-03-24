<tr>
    <td class="header" align="center" style="background-color: black" width="570" cellpadding="0" cellspacing="0">
        <a href="{{ $url }}" style="display: inline-block;">
            @if (trim($slot) === 'Laravel')
                <img style="width: 50%" class="user-avatar" src="{{ asset('images/LBB.png') }}" alt="Big Bill">
            @else
                {{ $slot }}
            @endif
        </a>
    </td>
</tr>
