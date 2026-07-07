
FILC = filec
OBJ = obj
INCLUDE =include

SRCS = $(wildcard $(FILC)/*.c)
OBJS = $(patsubst $(FILC)/%.c,$(OBJ)/%.o,$(SRCS))

CC = gcc
CFLAGS = -Wall -Wextra -ansi -pedantic -I$(INCLUDE)
LDFLAGS = -lgraph

EXEC = taquin

all: $(EXEC)

$(EXEC): $(OBJS)
	$(CC) $(OBJS) -o $@ $(LDFLAGS)


$(OBJ)/%.o: $(FILC)/%.c
	@mkdir -p $(OBJ)
	$(CC) $(CFLAGS) -c $< -o $@

clean:
	rm -rf $(OBJ)/*.o $(EXEC)