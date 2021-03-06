<div class="row mt-4">
    <div class="col-md-12">
        @if (count($answers) < 1)
            <div class="alert alert-primary" role="alert">
                {{ __('Be the first to answer that question!') }}
            </div>
        @else
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h2>{{ $answersCount . ' ' . __('answer(-s)')}}</h2>
                    </div>
                    <hr>
                    @include('layouts.successMessage')

                    @foreach ($answers as $answer)
                        @include('answers.deleteModal')

                        <div class="media answers">
                            <div class="d-flex flex-column vote-controls">
                                @cannot ('vote-own-answer', $answer)
                                    <a title="{{ __('Mark this answer as useful') }}"
                                       class="vote-up {{ $auth::guest() ? 'off' : '' }}
                                       {{ ($answer->user->id == $auth::id()) ? 'off' : '' }}"
                                       onclick="event.preventDefault(); document.getElementById( 'vote-up-answer-{{ $answer->id }}' ).submit();">
                                        <i class="fas fa-caret-up fa-3x"></i>
                                    </a>

                                    <form method="POST" class="vote-up-answer"
                                          action="/answers/{{ $answer->id }}/vote-answer"
                                          id="vote-up-answer-{{ $answer->id }}">
                                        @csrf
                                        <input type="hidden" name="vote_answer" value="1">
                                    </form>

                                    <span class="votes-count">{{ $answer->votes_count }}</span>

                                    <a title="{{ __('Mark this answer as not useful') }}"
                                       class="vote-down down-vote {{ $auth::guest() ? 'off' : '' }}
                                       {{ ($answer->user->id == $auth::id()) ? 'off' : '' }}"
                                       onclick="event.preventDefault(); document.getElementById('vote-down-answer-{{ $answer->id }}').submit();">
                                        <i class="fas fa-caret-down fa-3x"></i>
                                    </a>

                                    <form method="POST" class="vote-down-answer"
                                          action="/answers/{{ $answer->id }}/vote-answer"
                                          id="vote-down-answer-{{ $answer->id }}">
                                        @csrf
                                        <input type="hidden" name="vote_answer" value="-1">
                                    </form>
                                @else
                                    <a title="{{ __('You can not vote for your own answer') }}"
                                       class="off cursor-not-allowed">
                                        <i class="fas fa-caret-up fa-3x"></i>
                                    </a>

                                    <span class="votes-count">{{ $answer->votes_count }}</span>

                                    <a title="{{ __('You can not vote for your own answer') }}"
                                       class="off cursor-not-allowed">
                                        <i class="fas fa-caret-down fa-3x"></i>
                                    </a>
                                @endcannot

                                @can('mark-best-answer', $answer)
                                    <a title="{{ __('Mark this answer as best answer') }}"
                                       class="mt-3 mark-best-answer {{ $answer->status }}"
                                       onclick="event.preventDefault(); document.getElementById('mark-answer-{{ $answer->id }}').submit();">
                                        <i class="fa fa-plus fa-2x"></i>
                                    </a>
                                    <form method="POST" class="mark-answer"
                                          action="{{ route('answers.mark', $answer->id) }}"
                                          id="mark-answer-{{ $answer->id }}">
                                        @csrf
                                    </form>
                                @else
                                    @if ($answer->best_answer)
                                        <a title="{{ __('This answer is marked by the author as the best') }}"
                                           class="mt-3 {{ $answer->status }}">
                                            <i class="fa fa-plus fa-2x"></i>
                                        </a>
                                    @endif
                                @endcan
                            </div>

                            <div class="media-body">
                                <div class="mb-4">
                                    <div
                                        class="text-muted">{{ __('Answered') }} {{ $answer->created_at->format("M d,Y") }}
                                        {{ __('at') }} {{ $question->created_at->format("H:i") }}</div>
                                    <div class="media mt-1">
                                        <a href="{{ route('user.profile.show', $answer->user->id) }}"
                                           class="pr-2 text-decoration-none">
                                            <div class="media-body mt-1 d-flex align-items-center">
                                                <img src="{{ asset($answer->user->avatar) }}" alt="User avatar"
                                                     class="user-avatar user-avatar-mini">
                                                <h5 class="ml-2 mb-0">{{ $answer->user->name }}</h5>
                                                @if ($answer->user->id == $question->user->id)
                                                    <i class="ml-1 fa-solid fa-comment" alt="Question owner"></i>
                                                @endif
                                            </div>
                                        </a>
                                    </div>
                                </div>

                                <div class="answer-text pr-5">{!! $answer->body_html !!}</div>

                                <div class="row mb-2">
                                    <div class="col-4">
                                        <div class="ml-auto">
                                            @can('update-answer', $answer)
                                                <a href="{{ route('questions.answers.edit', [$question->id, $answer->id]) }}"
                                                   class="btn btn-sm btn-outline-info">{{ __('Edit') }}</a>
                                            @endcan

                                            @can('delete-answer', $answer)
                                                <a href="#deleteModal" data-toggle="modal">
                                                    <button type="submit" class="btn btn-sm btn-outline-danger ml-1">
                                                        {{ __('Delete') }}
                                                    </button>
                                                </a>
                                            @endcan
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
